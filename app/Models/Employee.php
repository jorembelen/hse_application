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

    public static function search($search)
    {
        return empty($search) ? static::query()
        : static::query()
            ->where('badge', 'like', '%'.$search.'%')
            ->orWhere('name', 'like', '%'.$search.'%')
            ->orWhere('designation', 'like', '%'.$search.'%');
    }
}
