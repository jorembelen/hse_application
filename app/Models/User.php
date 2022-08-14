<?php

namespace App\Models;

use App\Traits\UserTraits;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable, UserTraits;

    public $incrementing = false;
    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'id', 'name', 'email', 'password', 'role', 'username', 'location_id', 'status', 'profile_pic'
    ];

    /**
    * The attributes that should be hidden for serialization.
    *
    * @var array<int, string>
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
    * The attributes that should be cast.
    *
    * @var array<string, string>
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        User::creating(function ($model) {
            $model->setId();
        });
    }

    public function setId()
    {
        $this->attributes['id'] = Str::uuid();
    }

    public function userGreetings()
    {
        $greetings = "";
        $hour = date('H');
        if ($hour >= 18) {
            $greetings = "Good Evening";
        } elseif ($hour >= 12) {
            $greetings = "Good Afternoon";
        } elseif ($hour < 12) {
            $greetings = "Good Morning";
        }

        return $greetings .', Welcome Back';
    }

    public function remarks()
    {
        return $this->hasOne(Remark::class);
    }

    public function locations()
    {
        return $this->belongsTo(Location::class, 'location_id')->withDefault();
    }

    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }

    public function getAvatar() {
        if($this->profile_pic){
            return  Storage::disk('local')->url('files/avatar/'.$this->profile_pic);
        }
        return asset('/assets/img/avatars/no-image.png');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function hasLocation()
    {
        return $this->location_id != null;
    }

    public function userRole()
    {
        if($this->role === 'super_admin'){
            return 'Super Admin';
        }elseif($this->role === 'admin'){
            return 'Admin';
        }elseif($this->role === 'site_member'){
            return 'Site Member';
        }elseif($this->role === 'hse-member'){
            return 'HSE Member';
        }elseif($this->role === 'hsem'){
            return 'HSE Manager';
        }elseif($this->role === 'gm'){
            return 'General Manager';
        }elseif($this->role === 'user'){
            return 'Site User';
        }
    }

    public static function search($search)
    {
        return empty($search) ? static::query()
        : static::query()
            ->where('username', 'like', '%'.$search.'%')
            ->orWhere('name', 'like', '%'.$search.'%')
            ->orWhere('role', 'like', '%'.$search.'%')
            ->orWhere('email', 'like', '%'.$search.'%');
    }

}
