<?php
namespace App\Http\Controllers;
use Mail;
use Illuminate\Http\Request;
use App\Mail\email;
class MailController extends Controller{
    public function mail(){
        $name = 'Cuerpo del mensaje';
        Mail::to('garciabarreratoni@gmail.com')->send(new email($name));
        return 'Email sent Successfully';
    }
}

?>