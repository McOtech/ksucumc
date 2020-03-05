<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'image', 'fname', 'lname', 'sname', 'dob', 'regno', 'user_id',
         'course', 'doa', 'sex', 'phone', 'postalAddress', 'postalCode', 'town'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
