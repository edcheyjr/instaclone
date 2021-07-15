<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded =[];

   public function  profileImage(){
/**
 * ALTERNATIVE OF THIS
 *
 *
      $imagePath= ($this->image) ? $this->image : "/profile/hU5jbDNufZFzcjjWdcyFRssctSR5rsUZasgfWa2l.png";
       return "/storage/".$imagePath;
 *
 * IS
 *
 *  if($this->image){
           return "/storage/".$this->image;
       }
        else {
            return "/storage/profile/hU5jbDNufZFzcjjWdcyFRssctSR5rsUZasgfWa2l.png";
          }
 *
 **/

      return ($this->image) ? asset('storage/'.$this->image) : asset("/svg/download.png");
   }
   public function followers(){
       return $this ->belongsToMany(User::class);
   }

   public function user(){

       return $this->belongsTo(User::class);
   }
}
