<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cohort extends Model
{
    protected $fillable = [
        'category', 'name', 'image', 'about', 'policy', 'aboutContent', 'policyContent'
    ];

    public function membership(){
        return $this->hasMany(Membership::class);
    }

    public function events(){
        return $this->hasMany(Event::class);
    }

    public function images(){
        return $this->hasMany(CohortImage::class);
    }

    public function permissions(){
        return $this->hasMany(Permission::class);
    }
}
