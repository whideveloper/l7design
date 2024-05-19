<?php

namespace App\Http\Controllers;

use App\Models\GoogleForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class GoogleFormController extends Controller
{

    public function index()
    {
        if (!Auth::user()->can('google form.visualizar')) {
            return view('Admin.error.403');
        }
        $googleForm = GoogleForm::first();

        return view('Admin.cruds.googleForm.index', [
            'googleForm' => $googleForm
        ]);
    }

    public function create()
    {
        if (!Auth::user()->can(['google form.visualizar','google form.criar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.googleForm.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['active'] = $request->active?1:0;

        try {
            DB::beginTransaction();
                GoogleForm::create($data);
            DB::commit();
            Session::flash('success', 'Informação cadastrada com sucesso!');
            return redirect()->route('admin.dashboard.googleForm.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar informação!');
            return redirect()->route('admin.dashboard.googleForm.index');
        }
    }

    public function edit(GoogleForm $googleForm)
    {
        if (!Auth::user()->can(['google form.visualizar','google form.editar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.googleForm.edit', [
            'googleForm' => $googleForm
        ]);
    }

    public function update(Request $request, GoogleForm $googleForm)
    {
        $data = $request->all();
        $data['active'] = $request->active?1:0;

        try {
            DB::beginTransaction();
                $googleForm->fill($data)->save();
            DB::commit();
            Session::flash('success', 'Informação atualizada com sucesso!');
            return redirect()->route('admin.dashboard.googleForm.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar informação!');
            return redirect()->route('admin.dashboard.googleForm.index');
        }
    }

    public function destroy(GoogleForm $googleForm)
    {
        if (!Auth::user()->can(['google form.visualizar','google form.remover'])) {
            return view('Admin.error.403');
        }
        $googleForm->delete();
        Session::flash('success', 'Informação deletada com sucesso!');
        return redirect()->back();
    }
}
