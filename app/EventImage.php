<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{
    protected $fillable = [
        'image', 'title', 'event_id'
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }
}
