<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class ContactController extends Controller
{
  //

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|max:50|min:8',
      'email' => 'required|email',
      'msg' => 'required|min:10'

    ], [
      'name.required' => 'Name is required',
      'name.max' => 'Name must be less than 50 characters',
      'name.min' => 'Name must be at least 8 characters',
      'email.required' => 'Email is required',
      'email.email' => 'Email is not valid',
    ]);
    Contact::create(
      [
        'name' => $request->name,
        'email' => $request->email,
        'message' => $request->msg
      ]
    );

    return redirect('/allproducts')->with('success', 'Your message has been sent successfully');
  }
}
