<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name','user_name','user_type','status','profile_image', 'email','contact','permanent_add','temporary_add','join_date','department','role','data', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tasks(){
        return $this->belongsToMany(Task::class);
    }

    public function whereTask(){
        return $this->belongsToMany(Task::class)->where('status','!=','3');
    }

    public function isAdmin(){
        return $this->user_type;
    }

    public function telephone(){
        return $this->hasOne(Telephone::class,'user_id');

    }
}
