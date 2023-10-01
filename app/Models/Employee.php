<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public $fillable = [
        'badge',
        'name',
        'designation'
    ];

    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }

    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('badge', 'like', '%'.$search.'%')
                ->orWhere('designation', 'like', '%'.$search.'%');
            });
        }
        return $query;
    }

}
