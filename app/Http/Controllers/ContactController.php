<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//mailing
use Mail;
use App\Mail\Contact;

class ContactController extends Controller
{
    public function contact(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:100',
            'message' => 'required|string|max:255',
        ]);

        // get requests...
        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');

       //send mail
    try{
        
        //load intel to session
        session(['name' => $name]);
        session(['subject' => $subject]);
        session(['email' => $email]);
        session(['message' => $message]);
     
        Mail::to('henryonyemaobi@gmail.com')->send(new Contact()); 
  }
 catch(\Exception $e){
       return response()->Json('Email Failed, Please call Cohotek on +2348035562231');
      }

        return 'ok';
        

    }
}
