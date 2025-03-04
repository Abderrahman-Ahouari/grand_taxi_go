<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\facades\mail; 
use App\Mail\welcom_email;
class emailcontroller extends Controller
{
    public function SendWelcomEmail(){
        $toemail = "mikej89211@hartaria.com";
        $subject = "welcoming email";
        $message = "welcom to our taxi app, in this app you can take a taxi in 5 min";

        $responce = Mail::to($toemail)->send(new welcom_email($message, $subject));
        dd($responce);
    }
}
