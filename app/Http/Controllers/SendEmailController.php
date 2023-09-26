<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function enviarEmail(Request $request) {
        $mail = 'waggner.dev@gmail.com';
        Mail::to($mail)->send(new SendEmail($mail));

        Contact::create([
            'nome' => $request->nome,
            'email' => $request->email,
        ]);
        
        return 'Mensagem enviada com sucesso!';
    }
}
