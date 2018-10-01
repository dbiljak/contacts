<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Phone;
use App\Label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Http\Services\FilterContactsService;

class ApiController extends Controller {

  public function allContacts() {
    $filterService = new FilterContactsService();
    return $filterService->filterContacts();
  }

  public function allLabels() {
    $labels = Label::all();
    return $labels;
  }

  public function contactsFilter(Request $request) {
    $filterService = new FilterContactsService();
    return $filterService->filterContacts($request->input('filter'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function createContact(Request $request) {
    $contact = new Contact;
    if(Input::file('image') != NULL) {
      $image = Input::file('image');
      $image_name = str_slug($request->name) . "-" . time() . "." . $image->getClientOriginalExtension();
      $image->move('images', $image_name);
      $contact->image = $image_name;
    } else {
      $contact->image = Config('constants.default_image_name');
    }
    $contact->name = $request->name;
    $contact->surname = $request->surname;
    $contact->email = $request->email;
    $contact->favourite = $request->favourite == "on" ? 1 : 0;
    $contact->save();

    $labels = array();
    foreach ($request->labels as $key => $value) {
      $single_label = Label::where('name', $value)->first();
      if (!$single_label) {
        $new_label = new Label;
        $new_label->name = $value;
        $new_label->save();
        $labels[] = ['label_id'=> $new_label->id, 'phone_number' => $request->telephones[$key]];
      } else {
        $labels[] = ['label_id'=> $single_label->id, 'phone_number' => $request->telephones[$key]];
      }
    }
    $contact->labels()->sync($labels, false);

    return redirect()->route('contacts.show', $contact->id);
  }

  public function singleContact($id) {
    $contact = (new Contact())->where('id', $id)->with(['phones', 'phones.label'])->first();
    return $contact;
  }

  public function editContact($id) {
    $contact = (new Contact())->where('id', $id)->with(['phones', 'phones.label'])->first();
    return $contact;
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  \App\Contact  $contact
  * @return \Illuminate\Http\Response
  */
  public function updateContact(Request $request) {
    $contact = Contact::find($request->id);

    if(Input::file('image') != NULL) {
      $image = Input::file('image');
      $image_name = str_slug($request->name) . "-" . time() . "." . $image->getClientOriginalExtension();
      $image->move('images', $image_name);
      $contact->image = $image_name;
    }

    $contact->name = $request->name;
    $contact->surname = $request->surname;
    $contact->email = $request->email;
    $contact->favourite = $request->favourite == "on" ? 1 : 0;
    $contact->save();

    if (@$request->labels != null) {
      $labels = array();
      foreach ($request->labels as $key => $value) {
        $single_label = Label::where('name', $value)->first();
        if (!$single_label) {
          $new_label = new Label;
          $new_label->name = $value;
          $new_label->save();
          $labels[] = ['label_id'=> $new_label->id, 'phone_number' => $request->telephones[$key]];
        } else {
          $labels[] = ['label_id'=> $single_label->id, 'phone_number' => $request->telephones[$key]];
        }
      }
      $contact->labels()->detach();
      $contact->labels()->sync($labels, false);
    } else {
      $contact->labels()->detach();
    }
    return redirect()->route('contacts.show', $contact->id);
  }

  public function deleteContact($id) {
    $contact = Contact::find($id);
    $contact->delete();

    return redirect()->route('contacts.index');
  }

  /**
  * Display a listing of the resource.
  *
  * @param  \Illuminate\Http\Request $request
  * @return \Illuminate\Http\Response
  */
  public function searchContacts(Request $request) {

    $filterService = new FilterContactsService();
    $view_data['all'] = $filterService->filterContacts($request->input('filter'));

    $data = \View::make('components.contact_tables', $view_data)->render();

    return array('html' => $data);
  }

}
