<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(15);

        return view('Admin.cruds.contact.index',[
            'contacts' => $contacts
        ]);
    }

    public function show(Contact $contact)
    {
        //
    }

    public function edit(Contact $contact)
    {
        return view('Admin.cruds.contact.edit', [
            'contact' => $contact
        ]);
    }

    public function update(Request $request, Contact $contact)
    {
        $data = $request->all();

        $contact->fill($data)->save();
        Session::flash('success', 'Atualização realizada com sucesso!');

        return redirect()->route('admin.dashboard.contact.index');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        Session::flash('success', 'Item deletado com sucesso!');

        return redirect()->back();
    }

    public function destroySelected(Request $request)
    {
        if($deleted = Contact::whereIn('id', $request->deleteAll)->delete()){
            
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Contact::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
