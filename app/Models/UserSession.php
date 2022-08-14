<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class UserSession extends Model
{
    use HasFactory;

    protected $table = 'sessions';
    protected $appends = ['expires_at'];
    public $incrementing = false;

    public function isExpired()
    {
        return $this->last_activity < Carbon::now()->subMinutes(config('session.lifetime'))->getTimestamp();
    }

    public function getExpiresAtAttribute()
    {
        return Carbon::createFromTimestamp($this->last_activity)->addMinutes(config('session.lifetime'))->toDateTimeString();
    }

    public function getCreatedAtAttribute(){
        return Carbon::parse($this->attributes['last_activity'])->setTimezone("TimeZone identifier" );
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
