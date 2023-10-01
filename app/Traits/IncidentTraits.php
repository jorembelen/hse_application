<?php

namespace App\Traits;

use App\Mail\IncidentReportMail;
use App\Mail\InvestigationReportMail;
use App\Models\Incident;
use App\Models\Report;
use App\Models\RootCause;
use App\Models\User;
use App\Services\GreetingService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait IncidentTraits {

    public function addIncident($data)
    {
        $incidents = new Incident();

        if($data['cause']){
            $data['cause'] = implode(', ' , $data['cause']);
        }

        if($data['injury_sustain']){
            $data['injury_sustain'] = implode(', ' , $data['injury_sustain']);
        }

        if($data['injury_location']){
            $data['injury_location'] = implode(', ' , $data['injury_location']);
        }

        if($data['equipment']){
            $data['equipment'] = implode(', ' , $data['equipment']);
        }


        if($data['sel_involved'] == 'Employee')
        {
            $data['involved'] = implode(', ', $data['involved']);
        }else{
            $data['involved'] = $data['contractor'];
        }

        $images=array();
        if($data['hasImages'] === 1){

            $files = $data['images'];
            foreach($files as $file){

                // for saving original image
                $ImageUpload = Image::make($file);
                $originalPath = 'files/image/';
                $name = $file->hashName();
                $ImageUpload->stream();
                Storage::disk('s3')->put($originalPath .$name, $ImageUpload->__toString());

                // for saving thumnail image
                $thumbnailPath = 'files/thumbnail/';
                $ImageUpload->resize(300,200)->stream();
                Storage::disk('s3')->put($thumbnailPath .$name, $ImageUpload->__toString());

                // for saving to database
                $images[]=$name;
                $data['images'] = implode("|",$images);
            }
        }

        if($data['hasDocs'] === 1){
            $doc = $data['docs'];

            // get the name of the image
            $name = $doc->hashName();
            $docsPath = 'files/documents/' .$name;
            Storage::disk('s3')->put($docsPath, file_get_contents($doc->getRealPath()));
            $data['docs'] = $name;
        }

        $incident = $incidents->create($data);
    
        // $email = User::whereEmail('rcl.support@rezayat.net')->get()->pluck('email');
        $email = (new GreetingService())->getUserEmails($data['location']);
        $greetings = (new GreetingService())->getGreeting();

        //Send notification
        Mail::to($email)->send(new IncidentReportMail($incident, $greetings));

    }

    public function editIncident($data)
    {
        $incident = Incident::find($data['id']);
        if($data['cause']){
            $data['cause'] = implode(', ' , $data['cause']);
        }

        if($data['injury_sustain']){
            $data['injury_sustain'] = implode(', ' , $data['injury_sustain']);
        }

        if($data['injury_location']){
            $data['injury_location'] = implode(', ' , $data['injury_location']);
        }

        if($data['equipment']){
            $data['equipment'] = implode(', ' , $data['equipment']);
        }


        if($data['sel_involved'] == 'Employee')
        {
            $data['involved'] = implode(', ', $data['involved']);
        }else{
            $data['involved'] = $data['contractor'];
        }

        $images=array();
        if($data['hasImages'] === 1){

            $photos = explode("|", $incident->images);
            $files = $data['images'];
            foreach($files as $file){

                // for saving original image
                $ImageUpload = Image::make($file);
                $originalPath = 'files/image/';
                $name = $file->hashName();
                $ImageUpload->stream();
                Storage::disk('s3')->put($originalPath .$name, $ImageUpload->__toString());

                // for saving thumnail image
                $thumbnailPath = 'files/thumbnail/';
                $ImageUpload->resize(300,200)->stream();
                Storage::disk('s3')->put($thumbnailPath .$name, $ImageUpload->__toString());

                // for saving to database
                $images[]=$name;
                $data['images'] = implode("|",$images);

                // Remove old images
                if(count($photos) > 0){
                    //  dd($photos);
                    foreach($photos as $photo){
                        $path1 = 'files/image/';
                        $path2 = 'files/thumbnail/';
                        // Delete old image from file
                        Storage::disk('s3')->delete(parse_url($path1 .$photo));
                        Storage::disk('s3')->delete(parse_url($path2 .$photo));
                    }
                }

            }
        }

        if($data['hasDocs'] === 1){
            $doc = $data['docs'];

            // get the name of the image
            $name = $doc->hashName();
            $docsPath = 'files/documents/' .$name;
            // $path = $data['docs']->store($docsPath);
            Storage::disk('s3')->put($docsPath, file_get_contents($doc->getRealPath()));
            $data['docs'] = $name;

            // Delete old deocuments from file
            if($incident->docs) {
                $path = 'files/documents/';
                Storage::disk('s3')->delete(parse_url($path .$incident->docs));
            }
        }

        $incident->update($data);
    }

    public function addInvestigation($data)
    {

        $proofImgs=array();
        if($data['hasProof'] === 1){
            $files = $data['proof'];
            foreach($files as $file){

                // for saving original image
                $ImageUpload = Image::make($file);
                $originalPath = 'files/image/';
                $name = $file->hashName();
                $ImageUpload->stream();
                Storage::disk('s3')->put($originalPath .$name, $ImageUpload->__toString());

                $thumbnailPath = 'files/thumbnail/';
                $ImageUpload->resize(300,200)->stream();
                Storage::disk('s3')->put($thumbnailPath .$name, $ImageUpload->__toString());

                $proofImgs[]=$name;
                $data['proof'] = implode('|',$proofImgs);
            }
        }
        $images=array();
        if($data['hasImages'] === 1){
            $imgs = $data['inc_img'];

            foreach($imgs as $img){

                // for saving original image
                $ImageUpload = Image::make($img);
                $originalPath = 'files/image/';
                $name = $img->hashName();
                $ImageUpload->stream();
                Storage::disk('s3')->put($originalPath .$name, $ImageUpload->__toString());

                $thumbnailPath = 'files/thumbnail/';
                $ImageUpload->resize(300,200)->stream();
                Storage::disk('s3')->put($thumbnailPath .$name, $ImageUpload->__toString());

                $images[]=$name;
                $data['inc_img'] = implode("|",$images);
            }
        }

        if($data['hasDocs'] === 1){
            $doc = $data['docs'];

            $name = $doc->hashName();
            $docsPath = 'files/documents/' .$name;
            Storage::disk('s3')->put($docsPath, file_get_contents($doc->getRealPath()));
            $data['docs'] = $name;
        }

        $report = Report::create($data);

        foreach ($data['root_name'] as $key => $value) {

            $output = new RootCause();
            $output->incident_id = $data['incident_id'];
            $output->user_id = auth()->id();
            $output->root_name = $data['root_name'][$key];
            $output->rec_name = $data['rec_name'][$key];
            $output->rec_type = $data['rec_type'][$key];
            $output->type = $data['root_description'][$key];

            $report->rootcause()->save($output);

        }

        $email = (new GreetingService())->getUserEmails($data['location_id']);
        $greetings = (new GreetingService())->getGreeting();

        Mail::to($email)->send(new InvestigationReportMail($report, $greetings));

    }

    public function editInvestigation($data)
    {
        $report = Report::find($data['id']);
    
        $proofImgs=array();
        if($data['hasProof'] === 1){
            $proofs = explode("|", $report->proof);
            $files = $data['proof'];
            foreach($files as $file){

                // for saving original image
                $ImageUpload = Image::make($file);
                $originalPath = 'files/image/';
                $name = $file->hashName();
                $ImageUpload->stream();
                Storage::disk('s3')->put($originalPath .$name, $ImageUpload->__toString());

                $thumbnailPath = 'files/thumbnail/';
                $ImageUpload->resize(300,200)->stream();
                Storage::disk('s3')->put($thumbnailPath .$name, $ImageUpload->__toString());

                $proofImgs[]=$name;
                $data['proof'] = implode('|',$proofImgs);

                // Remove old images
                if(count($proofs) > 0){
                    foreach($proofs as $proof){
                        $path1 = 'files/image/';
                        $path2 = 'files/thumbnail/';
                        // Delete old image from file
                        Storage::disk('s3')->delete(parse_url($path1 .$proof));
                        Storage::disk('s3')->delete(parse_url($path2 .$proof));
                    }
                }
            }
        }
        $images=array();
        if($data['hasImages'] === 1){
            $incImages = explode("|", $report->inc_img);
            $imgs = $data['inc_img'];
            foreach($imgs as $img){

                // for saving original image
                $ImageUpload = Image::make($img);
                $originalPath = 'files/image/';
                $name = $img->hashName();
                $ImageUpload->stream();
                Storage::disk('s3')->put($originalPath .$name, $ImageUpload->__toString());

                $thumbnailPath = 'files/thumbnail/';
                $ImageUpload->resize(300,200)->stream();
                Storage::disk('s3')->put($thumbnailPath .$name, $ImageUpload->__toString());

                $images[]=$name;
                $data['inc_img'] = implode("|",$images);

                // Remove old images
                if(count($incImages) > 0){
                    foreach($incImages as $image){
                        $path3 = 'files/image/';
                        $path4 = 'files/thumbnail/';
                        // Delete old image from file
                        Storage::disk('s3')->delete(parse_url($path3 .$image));
                        Storage::disk('s3')->delete(parse_url($path4 .$image));
                    }
                }
            }
        }

        if($data['hasDocs'] === 1){
            $doc = $data['docs'];
            $name = $doc->hashName();
            $docsPath = 'files/documents/' .$name;
            Storage::disk('s3')->put($docsPath, file_get_contents($doc->getRealPath()));
            $data['docs'] = $name;

            // Delete old deocuments from file
            if($report->docs) {
                $path = 'files/documents/';
                $path = 'storage/uploads/documents/';
                Storage::disk('s3')->delete(parse_url($path .$report->docs));
            }
        }

        $report->update($data);

    }



}
