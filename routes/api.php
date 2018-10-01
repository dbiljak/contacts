<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('contacts', 'ApiController@contactsFilter')->name('contacts');
Route::get('all-contacts', 'ApiController@allContacts')->name('all-contacts');
Route::get('contacts/{id}', 'ApiController@singleContact')->name('show-contact');
Route::post('search-contacts', 'ApiController@searchContacts')->name('search-contacts');
Route::post('create-contact', 'ApiController@createContact')->name('create-contact');
Route::get('edit-contact/{id}', 'ApiController@editContact')->name('edit-contact');
Route::put('update-contact/{id}', 'ApiController@updateContact')->name('update-contact');
Route::delete('delete-contact/{id}', 'ApiController@deleteContact')->name('delete-contact');


Route::get('labels', 'ApiController@allLabels')->name('labels');
