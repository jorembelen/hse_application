@section('title', 'Investigation Details')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ session()->has('previousRoute') ? url(session()->get('previousRoute')) : url()->previous() }}" type="button"class="btn btn-dark mb-2 float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg>
                        Back
                    </a>
                    <h3>Report ID: {{ $report->id }}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mb-4">
                        <thead>

                        </thead>
                        <tbody>
                            <tr>
                                <td width="25%"><strong>Employees Name</strong></td>
                                <td>: {{ $report->incident->involved }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Line Manager Name</strong></td>
                                <td>: {{ $report->manager->badge }} - {{ $report->manager->name }} ({{ $report->manager->designation }})</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Supervisor Name</strong></td>
                                <td>: {{ $report->supervisor->badge }} - {{ $report->supervisor->name }} ({{ $report->supervisor->designation }})</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Project Devision/Department</strong></td>
                                <td>: {{ $report->location->division }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Project Name</strong></td>
                                <td>: {{ $report->location->name }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Project Location</strong></td>
                                <td>: {{ $report->location->loc_name }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Place of the Incident</strong></td>
                                <td>: {{ $report->inc_loc }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Date & Time of Incident</strong></td>
                                <td>: {{ date('M-d-Y h:i a', strtotime($report->incident->date)) }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Nature of Incident</strong></td>
                                <td>: {{ $report->nature }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Brief Description</strong></td>
                                <td>: {{ $report->description }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Details of the Injury</strong></td>
                                <td>: {{ $report->details }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>First Aid Given?</strong></td>
                                <td>: {{ $report->aid }}</td>
                            </tr>
                            @if($report->aid == 'Yes')
                            <tr>
                                <td width="25%"><strong>Name of First Aider</strong></td>
                                <td>: {{ $report->nurse->badge }} - {{ $report->nurse->name }} ({{ $report->nurse->designation }})</td>
                            </tr>
                            @endif
                            <tr>
                                <td width="25%"><strong>Hospitalized?</strong></td>
                                <td>: {{ $report->hosp }}</td>
                            </tr>
                            @if($report->hosp == 'Yes')
                            <tr>
                                <td width="25%"><strong>Hospital Name</strong></td>
                                <td>: {{ $report->hospital }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Hospital Address</strong></td>
                                <td>: {{ $report->hos_addr }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Medical Leave Given?</strong></td>
                                <td>: {{ $report->med_leave }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Number of Days</strong></td>
                                <td>: {{ $report->leave_days }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td width="25%"><strong>Property Damaged?</strong></td>
                                <td>: {{ $report->prop_dam }}</td>
                            </tr>
                            @if($report->aid == 'Yes')
                            <tr>
                                <td width="25%"><strong>Estimated Damage Percentage</strong></td>
                                <td>: {{ $report->est_dam }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Estimated Cost of Damage (SAR)</strong></td>
                                <td>: {{ $report->est_amt }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Type/Function of Property</strong></td>
                                <td>: {{ $report->property }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Location of Property</strong></td>
                                <td>: {{ $report->prop_loc }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Manufacturer's Name</strong></td>
                                <td>: {{ $report->prop_manuf }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Property Model</strong></td>
                                <td>: {{ $report->prop_model }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Plate No.</strong></td>
                                <td>: {{ $report->prop_plate }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Vehicle Registration No.</strong></td>
                                <td>: {{ $report->prop_reg }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Company Fleet No.</strong></td>
                                <td>: {{ $report->prop_rte }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td width="25%"><strong>Was Pre-Task/Toolbox Meeting Conducted?</strong></td>
                                <td>: {{ $report->toolbox }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Was the Person Using Required PPE?</strong></td>
                                <td>: {{ $report->ppe }}</td>
                            </tr>
                            @if($report->ppe == 'Yes')
                            <tr>
                                <td width="25%"><strong>Specify Personal Protective Equipment (PPE)</strong></td>
                                <td>: {{ $report->ppe_equip }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td width="25%"><strong>What was the injured person/employee doing at the time of the incident?</strong></td>
                                <td>: {{ $report->emp_doing }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>What was the machine/equipment doing at the time of the incident?</strong></td>
                                <td>: {{ $report->emp_machine }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>What was the machine/equipment doing at the time of the incident?</strong></td>
                                <td>: {{ $report->emp_material }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>Immediate Cause(s) of the Incident/injury</strong></td>
                                <td>: {{ $report->imm_cause }}</td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>
                                    <a class="bs-tooltip" title="Click to view details!" href="{{ route('report.recommendation', $report->id) }}">Root Cause(s) of the Incident/injury</a>
                                </strong></td>
                                <td>
                                    @foreach($output as  $item)
                                    <li>{{ $loop->iteration }}. {!! $item->type !!} - {!! $item->root_name !!}</li>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <td width="25%"><strong>
                                    <a class="bs-tooltip" title="Click to view details!" href="{{ route('report.recommendation', $report->id) }}">Corrective Action(s) to prevent reoccurence</a>
                                </strong></td>
                                <td>
                                    @foreach($output as  $item)
                                    <li> {{ $loop->iteration }}. {!! $item->rec_type !!} - {!! $item->rec_name !!} (
                                        @if($item->status == 0)
                                        On Going
                                        @else
                                        Done
                                        @endif )</li>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td width="25%"><strong>Were there any witnesses?</strong></td>
                                    <td>: {{ $report->witness }}</td>
                                </tr>
                                @if($report->witness == 'Yes')
                                <tr>
                                    <td width="25%"><strong>Type of witness(es)</strong></td>
                                    <td>: {{ $report->wit_type }}</td>
                                </tr>
                                <tr>
                                    <td width="25%"><strong>Witness Details</strong></td>
                                    <td>: {{ $report->wit_details }}</td>
                                </tr>
                                <tr>
                                    <td width="25%"><strong>Witness Statement</strong></td>
                                    <td>: {{ $report->wit_statement }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td width="25%"><strong>Safety Awareness Training Date</strong></td>
                                    <td>: {{ date('M-d-Y', strtotime($report->safety)) }}</td>
                                </tr>
                                <tr>
                                    <td width="25%"><strong>Proof of Training</strong></td>
                                    <td>: {{ $report->proof_training }}</td>
                                </tr>
                                @if (count($report->remark) > 0)
                                <tr>
                                    <td width="25%"><strong><h5 class="text-primary">Manager Remarks</h5></strong></td>
                                    <td><h5 class="text-primary">: {{ $report->remark[0]['status'] }} - {{ $report->remark[0]['note'] }} </h5></td>
                                </tr>
                                @endif
                                @if($report->docs)
                                <tr>
                                    <td>
                                        <a class="bs-tooltip" title="Click to download this attachment!" href="{{ Storage::disk('s3')->url('files/documents/'.$report->docs ) }}" target="_blank" rel="noopener noreferrer">
                                            <button class="btn btn-danger mb-2 mr-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                                Attachment</button>
                                            </a>
                                        </td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                            <div class="row">
                                @if($report->proof)
                                <div class="col-md-6">
                                    <div class="widget-content widget-content-area">
                                        <h5>Proof of Training Image(s)</h5>
                                        <div id="demo-test-gallery" class="demo-gallery" data-pswp-uid="1">

                                            @foreach ($photos as $image)
                                            <a class="img-1" href="{{ Storage::disk('s3')->url('files/image/'.$image ) }}" data-size="1600x1068" data-med="{{ Storage::disk('s3')->url('files/image/'.$image ) }}" data-med-size="1024x683" data-author="Samuel Rohl">
                                                <img src="{{ Storage::disk('s3')->url('files/thumbnail/'.$image ) }}" alt="image-gallery">

                                            </a>
                                            @endforeach

                                        </div>
                                        <!-- Root element of PhotoSwipe. Must have class pswp. -->
                                        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

                                            <!-- Background of PhotoSwipe. It's a separate element, as animating opacity is faster than rgba(). -->
                                            <div class="pswp__bg"></div>

                                            <!-- Slides wrapper with overflow:hidden. -->
                                            <div class="pswp__scroll-wrap">
                                                <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
                                                <!-- don't modify these 3 pswp__item elements, data is added later on. -->
                                                <div class="pswp__container">
                                                    <div class="pswp__item"></div>
                                                    <div class="pswp__item"></div>
                                                    <div class="pswp__item"></div>
                                                </div>

                                                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                                                <div class="pswp__ui pswp__ui--hidden">

                                                    <div class="pswp__top-bar">

                                                        <!--  Controls are self-explanatory. Order can be changed. -->
                                                        <div class="pswp__counter"></div>
                                                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                                                        <button class="pswp__button pswp__button--share" title="Share"></button>
                                                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                                                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                                                        <!-- element will get class pswp__preloader--active when preloader is running -->
                                                        <div class="pswp__preloader">
                                                            <div class="pswp__preloader__icn">
                                                                <div class="pswp__preloader__cut">
                                                                    <div class="pswp__preloader__donut"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                                        <div class="pswp__share-tooltip"></div>
                                                    </div>
                                                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                                                    </button>
                                                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                                                    </button>
                                                    <div class="pswp__caption">
                                                        <div class="pswp__caption__center"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @if($report->inc_img)
                                <div class="col-md-6">
                                    <div class="widget-content widget-content-area">
                                        <h5>Incident Image(s)</h5>
                                        <div id="demo-test-gallery" class="demo-gallery" data-pswp-uid="1">
                                            @foreach ($images as $img)
                                            <a class="img-1" href="{{ Storage::disk('s3')->url('files/image/'.$img ) }}" data-size="1600x1068" data-med="{{ $img ? Storage::disk('s3')->url('files/image/'.$img ) : null }}" data-med-size="1024x683" data-author="Samuel Rohl">
                                                <img src="{{ Storage::disk('s3')->url('files/thumbnail/'.$img ) }}" alt="image-gallery">

                                            </a>
                                            @endforeach


                                        </div>
                                        <!-- Root element of PhotoSwipe. Must have class pswp. -->
                                        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

                                            <!-- Background of PhotoSwipe. It's a separate element, as animating opacity is faster than rgba(). -->
                                            <div class="pswp__bg"></div>

                                            <!-- Slides wrapper with overflow:hidden. -->
                                            <div class="pswp__scroll-wrap">
                                                <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
                                                <!-- don't modify these 3 pswp__item elements, data is added later on. -->
                                                <div class="pswp__container">
                                                    <div class="pswp__item"></div>
                                                    <div class="pswp__item"></div>
                                                    <div class="pswp__item"></div>
                                                </div>

                                                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                                                <div class="pswp__ui pswp__ui--hidden">

                                                    <div class="pswp__top-bar">

                                                        <!--  Controls are self-explanatory. Order can be changed. -->
                                                        <div class="pswp__counter"></div>
                                                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                                                        <button class="pswp__button pswp__button--share" title="Share"></button>
                                                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                                                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                                                        <!-- element will get class pswp__preloader--active when preloader is running -->
                                                        <div class="pswp__preloader">
                                                            <div class="pswp__preloader__icn">
                                                                <div class="pswp__preloader__cut">
                                                                    <div class="pswp__preloader__donut"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                                        <div class="pswp__share-tooltip"></div>
                                                    </div>
                                                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                                                    </button>
                                                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                                                    </button>
                                                    <div class="pswp__caption">
                                                        <div class="pswp__caption__center"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <h8 >Submitted by: <strong>{{ $report->user->name }} - ({{ date('M-d-Y h:i a', strtotime($report->created_at)) }})</strong></h8>
            @if(auth()->user()->role == 'user' || auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
            <a href="#" type="button"class="btn btn-danger mb-2 float-right" wire:click.prevent="confirmDelete('{{ $report->id }}')">
               <i class="fa fa-trash"></i> Delete
            </a>
            @endif
        </div>
    </div>
</div>

</div>
