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

      $imagePath= ($this->image) ? $this->image : "/profile/hU5jbDNufZFzcjjWdcyFRssctSR5rsUZasgfWa2l.png";
       return "/storage/".$imagePath;
   }

   public function user(){

       return $this->belongsTo(User::class);
   }
}
