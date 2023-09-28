<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\RecoverPasswordRequest;

class ResetPasswordController extends Controller
{
    public function showResetForm(){
        return view('Admin.auth.reset-password');
    }

    public function reset(RecoverPasswordRequest $request, User $user){
        // Recupere o token e a nova senha do formulário de solicitação
        $token = $request->token;
        $newPassword = $request->password;

        // Verifique se o token de redefinição de senha é válido na tabela password_resets
        $passwordReset = PasswordReset::where('token', $token)->first();

        if (!$passwordReset) {
            // O token não é válido
            Session::flash('error', 'Token de redefinição de senha inválido.');
            return redirect()->route('admin.dashboard.painel');
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        // Remover o token de redefinição de senha, já que foi usado
        $passwordReset->delete();

        Session::flash('success', 'Senha alterada com sucesso!');
        return redirect()->route('admin.dashboard.painel'); 
    }
}
