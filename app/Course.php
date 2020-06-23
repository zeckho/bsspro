<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'image', 'excerpt', 'description', 'status', 'user_id', 'started_at', 'finish_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function user_courses()
    {
        return $this->hasOne('App\UserCourse');
    }

    public function lessons()
    {
        return $this->hasMany('App\Lesson');
    }

    public function getStartedDateAttribute()
    {
        return Carbon::parse($this->attributes['started_at'])->format('d/m/Y');
    }

    public function getFinishDateAttribute()
    {
        return Carbon::parse($this->attributes['finish_at'])->format('d/m/Y');
    }
}
