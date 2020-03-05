<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CohortImage extends Model
{
    protected $fillable = [
        'image', 'title', 'cohort_id'
    ];

    public function cohort(){
        return $this->belongsTo(Cohort::class);
    }
}
