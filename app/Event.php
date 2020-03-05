<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'cohort_id', 'name', 'date', 'venue', 'location', 'image', 'description', 'status'
    ];

    public function cohort(){
        return $this->belongsTo(Cohort::class);
    }

    public function videos(){
        return $this->hasMany(Event_Video::class);
    }

    public function images(){
        return $this->hasMany(EventImage::class);
    }
}
