<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  public function phones() {
    return $this->hasMany("App\Phone", "contact_id");
  }

  public function labels() {
    return $this->belongsToMany('App\Label', 'phones', 'contact_id', 'label_id')->withPivot('phone_number');
  }

  // this is a recommended way to declare event handlers
   public static function boot() {
       parent::boot();

       static::deleting(function($contact) { // before delete() method call this
            $contact->phones()->delete();
            // do the rest of the cleanup...
       });
   }
}
