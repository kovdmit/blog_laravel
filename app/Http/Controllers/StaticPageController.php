<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class StaticPageController extends Controller
{
    public function contact()
    {
        return view('contact');
    }

    public function sendmail(Request $request)
    {
        if ($request->method() == 'POST') {
            $body = "<p>ФИО: $request->name</p>";
            $body .= "<p>Email: $request->email</p>";
            $body .= "<p>Тема: $request->subject</p>";
            $body .= "<p>Сообщение: $request->message</p>";
            Mail::to('pzhabbiu@gmail.com')->send(new ContactMail($body));
            return view('mail.send');
        }
        return abort(404);
    }
}
