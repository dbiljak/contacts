<?php

namespace App\Http\Services;

use App\Contact;
use App\Phone;

class FilterContactsService {

  public function filterContacts($filter = false){
    $contacts = (new Contact())->with(['phones', 'phones.label']);

    if($filter != false){
      $filter = $this->trimFilter($filter);
      $contacts
      ->where('name', 'like', '%'.$filter.'%')
      ->orWhere('surname', 'like', '%'.$filter.'%')
      ->orWhere('email', 'like', '%'.$filter.'%');
    }

    $data['contacts'] = $contacts->get();
    $data['favourites'] = [];
    foreach($data['contacts'] as $cont){
      if($cont->favourite === 1){
        $data['favourites'][] = $cont;
      }
    }
    if ($filter == false) {
      return $data;
    } else {
      return (object)$data;
    }
  }

  private function trimFilter($filter){
    return $filter;
  }
}
