<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
  public function contacts() {
    return $this->belongsToMany('App\Contact', 'phones', 'label_id', 'contact_id')->withPivot('phone_number');
  }
}
