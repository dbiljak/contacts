<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Phone;
use App\Label;
use Illuminate\Support\Facades\Input;

use App\Http\Services\FilterContactsService;
use Illuminate\Http\Request;

class ContactController extends Controller {

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index() {
    $data['all'] = json_decode(file_get_contents(Config('constants.api_domain') . "api/all-contacts"));
    return view('contacts', $data);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create() {
    $data['labels'] = file_get_contents(Config('constants.api_domain') . "api/labels");
    return view('create', $data);
  }

  /**
  * Display the specified resource.
  *
  * @param  \App\Contact  $contact
  * @return \Illuminate\Http\Response
  */
  public function show(Contact $contact) {
    $data['contact'] = json_decode(file_get_contents(Config('constants.api_domain') . "api/contacts/" . $contact->id));
    return view('contact', $data);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  \App\Contact  $contact
  * @return \Illuminate\Http\Response
  */
  public function edit(Contact $contact) {
    $data['labels'] = file_get_contents(Config('constants.api_domain') . "api/labels");
    $data['contact'] = json_decode(file_get_contents(Config('constants.api_domain') . "api/edit-contact/" . $contact->id));
    return view('edit', $data);
  }

}
