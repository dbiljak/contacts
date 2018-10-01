<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
  public function label() {
    return $this->belongsTo('App\Label');
  }
  //
  // public function contact() {
  //   return $this->belongsToMany('App\Contact', 'phones', 'label_id', 'contact_id')->withPivot('phone_number');
  // }
}
