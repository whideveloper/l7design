<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Helpers\HelperArchive;

class GalleryController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/galeria/';
    public function index()
    {
        if (!Auth::user()->can('galeria.visualizar')) {
            return view('Admin.error.403');
        }
        $galleries = Gallery::sorting()->paginate(30);
        return view('Admin.cruds.gallery.index', [
            'galleries' => $galleries
        ]);
    }

    public function create()
    {
        if (!Auth::user()->can(['galeria.visualizar','galeria.criar'])) {
            return view('Admin.error.403');
        }
        return view('Admin.cruds.gallery.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) {
                $data['path_image'] = $this->pathUpload . $path_image;
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }
            $data['slug'] = Str::slug($request->title,'-','pt-BR');
            $data['active'] = $request->active ? 1 : 0;

            if (!$gallery = Gallery::create($data)) {
                Storage::delete($this->pathUpload . $path_image);
                throw new Exception();
            }            
            DB::commit();

            Session::flash('success', 'Galeria cadastrada com sucesso!');
            return redirect()->route('admin.dashboard.gallery.edit', [
                'gallery' => $gallery
            ]);
        }catch(\Exception $exception){
            dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar Galeria!');
            return redirect()->back();
        }
    }

    public function edit(Gallery $gallery)
    {
        if (!Auth::user()->can(['galeria.visualizar','galeria.editar'])) {
            return view('Admin.error.403');
        }
        $gallery = Gallery::with(['galleryImage' => function ($query) {
            $query->orderBy('sorting', 'ASC');
        }])
        ->find($gallery->id);

        return view('Admin.cruds.gallery.edit', [
            'gallery' => $gallery
        ]);
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) {
                $data['path_image'] = $this->pathUpload . $path_image;
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
                Storage::delete($gallery->path_image);
            }
            if(isset($request->delete_path_image) && !$path_image){
                $inputFile = $request->delete_path_image;
                Storage::delete($gallery->$inputFile);
                $data['path_image'] = null;
            }
            $data['slug'] = Str::slug($request->title,'-','pt-BR');
            $data['active'] = $request->active ? 1 : 0;


            $gallery->fill($data)->save();

            if ($path_image) {
                Storage::delete($this->pathUpload . $path_image);
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }

            DB::commit();
            Session::flash('success', 'Galeria atualizada com sucesso!');
            return redirect()->route('admin.dashboard.gallery.edit', [
                'gallery' => $gallery
            ]);
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o Galeria!');
            return redirect()->back();
        }
    }
    public function destroy(Gallery $gallery)
    {
        if(!Auth::user()->can(['galeria.visualizar', 'galeria.remover'])){
            return view('Admin.error.403');
        }
        Storage::delete($gallery->path_image);
        $gallery->delete();
        Session::flash('success', 'Galeria Deletada com sucesso!');
        return redirect()->back();
    }
    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['galeria.visualizar','galeria.remover'])) {
            return view('Admin.error.403');
        }

        if($deleted = Gallery::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Gallery::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
