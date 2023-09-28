<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UserUpdateRequest;

class ResetPasswordController extends Controller
{
    public function showResetForm(){
        return view('Admin.auth.reset-password');
    }

    public function reset(UserUpdateRequest $request, User $user){

        $data['password'] = Hash::make($request->password);
        $user->fill($data)->save();

        Session::flash('success', 'Senha alterada com sucesso!');
        return redirect()->route('admin.dashboard.painel');
    }
}
