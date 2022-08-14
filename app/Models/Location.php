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

    public static function search($search)
    {
        return empty($search) ? static::query()
        : static::query()
            ->where('division', 'like', '%'.$search.'%')
            ->orWhere('name', 'like', '%'.$search.'%')
            ->orWhere('loc_name', 'like', '%'.$search.'%');
    }


}
