<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ContactTelenordeste;
use App\Models\GoogleForm;
use Illuminate\Http\Request;

class ContactTelenordestePageController extends Controller
{
    public function index(){
        $contatos = ContactTelenordeste::sorting()->active()->get();
        $googleForm = GoogleForm::active()->first();
        return view('Client.pages.contato', [
            'contatos' => $contatos,
            'googleForm' => $googleForm,
        ]);
    }   
}
