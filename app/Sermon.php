<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sermon extends Model
{
    protected $fillable = [
        'image', 'title', 'date', 'preacher', 'url', 'content'
    ];
}
