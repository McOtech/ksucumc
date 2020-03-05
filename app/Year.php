<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = ['year'];

    public function leaders()
    {
      return $this->belongsToMany(Leader::class);
    }

}
