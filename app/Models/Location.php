<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public $fillable = [
        'division',
        'name',
        'loc_name'
    ];

    public function incident()
    {
        return $this->hasMany(Incident::class, 'location');
    }


    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('division', 'like', '%'.$search.'%')
                ->orWhere('loc_name', 'like', '%'.$search.'%');
            });
        }
        return $query;
    }

}
