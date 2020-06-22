<?php

namespace App;

use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guard_name = 'api';
        
    public function getCreatedDateAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d/m/Y H:i');
    }

    public function getModifiedDateAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->format('d/m/Y H:i');
    }

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
}
