<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //contact
    public function contact(){
        return view('user.contact.contactForm');
    }
    public function contacting(Request $request){
        // dd($request->all());
        $this->contactValidate($request);
        $data = $this->requestMail($request);
        Contact::create($data);
        return back()->with(['sentSuccess'=>'You sent your message...']);
    }

    private function contactValidate($request){
        Validator::make($request->all(),[
            'userName' => 'required',
            'userEmail' => 'required',
            'userMessage' => 'required'
        ])->validate();
    }
    private function requestMail($request){
        return [
            'name'=> $request->userName,
            'email'=> $request->userEmail,
            'message'=>$request->userMessage
        ];
    }
}
