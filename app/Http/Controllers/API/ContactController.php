<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use Mail; 

class ContactController extends Controller
{
    public $successStatus = 200;
    public function getContact() { 

        return view('contact_us'); 
    } 
 
       public function saveContact(Request $request) { 
 
         $this->validate($request, [
             'name' => 'required',
             'email' => 'required|email',
             'message' => 'required'
         ]);
 
         $contact = new Contact;
 
         $contact->name = $request->name;
         $contact->email = $request->email;
         $contact->message = $request->message;
 
         $contact->save();
         
         \Mail::send('contact_email',
             array(
             'name' => $request->get('name'),
             'email' => $request->get('email'),
             'user_message' => $request->get('message'),
            ), function($message) use ($request)
           {
              $message->from($request->email);
              $message->to('sjestablishmentcrowdmonitoring@gmail.com');
           });

        return response()->json(['success' =>  $contact], $this-> successStatus);
    }  
}
