<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\ResetPasswordController;

class ForgotPasswordController extends Controller
{
    public function viewForm(){
        return view('Admin.auth.recover-password');
    }

    public function sendResetLinkEmail(Request $request){
        // Validação dos dados de entrada
        $request->validate([
            'email' => 'email',
        ]);
    
        $user = User::where('email', $request->email)->first();
        
        if (!$user) {
            return back()->withErrors(['email' => 'Usuário não encontrado']);
        }
    
        $user->notify(new ResetPasswordController($user->createTokenForPasswordReset()));
    
        return back()->with('status', 'Link de redefinição de senha enviado com sucesso!');
    }
}
