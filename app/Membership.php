<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'cohort_id', 'user_id', 'post', 'right'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cohort(){
        return $this->belongsTo(Cohort::class);
    }
}
