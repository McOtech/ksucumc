<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Leader extends Model
{

    use SoftDeletes;

    protected $fillable = [
        'name', 'course', 'description', 'image', 'message','position_id'
      ];


      public function years()
      {
        return $this->belongsToMany(Year::class);
      }

      /**
       * check if post has tag
       *
       * @return bool
      */
    //   public function hasYear($tagId)
    //   {
    //     return in_array($yearId, $this->tags->pluck('id')->toArray());
    //   }

    public function deleteImage()
    {
      Storage::delete($this->image);
    }

    public function position()
    {
      return $this->belongsTo(Position::class);
    }

    public function hasYear($YearId)
    {
      return in_array($YearId, $this->years->pluck('id')->toArray());
    }

}

