<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Helpers\HelperArchive;

class GalleryImageController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/gallery-image/';
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
    
            foreach ($request->file('path_image') as $file) {
                // Renomear o arquivo, se necessário
                $fileName = time() . '_' . $file->getClientOriginalName();
                

                $file->storeAs($this->pathUpload, $fileName);
    
                // Criar um registro no banco de dados para cada imagem
                GalleryImage::create([
                    'gallery_id' => $request->gallery_id,
                    'path_image' => $this->pathUpload . $fileName,
                ]);
            }
    
            DB::commit();
    
            Session::flash('success', 'Imagens cadastradas com sucesso!');
            return redirect()->route('admin.dashboard.gallery.edit', [
                'gallery' => $request->gallery_id
            ]);
    
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar imagens!');
            return redirect()->route('admin.dashboard.gallery.index');
        }
    }
    
    public function destroy(GalleryImage $galleryImage)
    {
        if (!Auth::user()->can(['galeria.visualizar','galeria.remover'])) {
            return view('Admin.error.403');
        }
        Storage::delete($this->pathUpload.$galleryImage->path_image);
        
        $galleryImage->delete();

        Session::flash('success','imagem deletada com sucesso!');
        return redirect()->back();
    }

    /**
     * Remove the selected resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['galeria.visualizar','galeria.remover'])) {
            return view('Admin.error.403');
        }
        $galleryImages = GalleryImage::whereIn('id', $request->deleteAll)->get();

        foreach($galleryImages as $galleryImage){
            Storage::delete($galleryImage->path_image);
        }

        if($deleted = GalleryImage::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso']);
        }
    }

    /**
    * Sort record by dragging and dropping
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            GalleryImage::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }
}
