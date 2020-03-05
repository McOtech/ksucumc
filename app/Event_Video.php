<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_Video extends Model
{
    protected $fillable = [
        'event_id', 'image', 'title', 'url', 'description'
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }
}
