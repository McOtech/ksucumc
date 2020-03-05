<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['right', 'cohort_id'];
    public function cohort(){
        return $this->belongsTo(Cohort::class);
    }
}
