<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $fillable = [
        'title', 'slug', 'image', 'video', 'excerpt', 'description', 'status', 'started_at', 'finish_at'
    ];

    public function getStartedDateAttribute()
    {
        return Carbon::parse($this->attributes['started_at'])->format('d/m/Y');
    }

    public function getFinishDateAttribute()
    {
        return Carbon::parse($this->attributes['finish_at'])->format('d/m/Y');
    }
}
