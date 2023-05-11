<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

use App\Mail\NotifyMail;
use App\Models\section6;

include 'InitialValues.php';

class SendEmailController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'email | required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $section6 = section6::all();
        $contact = $section6[0]->email;

        $data = [
            'email' => $request->email,
            'name' => $request->name,
            'subject' => $request->subject,
            'body' => $request->message,
        ];

        Mail::to($contact)->send(new NotifyMail($data));

        return redirect()
            ->route('welcome')
            ->with('success', 'Correo enviado satisfactoriamente.');
    }
}
