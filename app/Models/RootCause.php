<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RootCause extends Model
{
    use HasFactory;

    public $fillable = [
        'user_id',
        'report_id',
        'incident_id',
        'root_name',
        'type',
        'rec_name',
        'rec_type',
        'status'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
        : static::query()
            ->where('incident_id', 'like', '%'.$search.'%')
            ->orWhere('type', 'like', '%'.$search.'%')
            ->orWhere('rec_type', 'like', '%'.$search.'%');
    }

}
