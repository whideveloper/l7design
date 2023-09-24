<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

class SendEmailController extends Controller
{
    public function enviarEmail() {
        $mail = 'waggner.dev@gmail.com';
        Mail::to($mail)->send(new SendEmail($mail));

        return 'Mensagem enviada com sucesso!';
    }
}
