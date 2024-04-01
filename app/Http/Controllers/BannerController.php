<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BannerStoreRequest;
use App\Http\Requests\BannerUpdateRequest;
use App\Http\Controllers\Helpers\HelperArchive;
use Illuminate\Support\Facades\Response;

class BannerController extends Controller
{
    protected $pathUpload = 'admin/uploads/images/banner/';

    public function index()
    {
        if(!Auth::user()->can('banners.visualizar')){
            return view('Admin.error.403');
        }
        $banners = Banner::sorting()->paginate();
        return view('Admin.cruds.banner.index', [
            'banners' => $banners
        ]);
    }

    public function create()
    {
        if(!Auth::user()->can(['banners.visualizar','banners.criar'])){
            return view('Admin.error.403');
        }

        return view('Admin.cruds.banner.create');
    }

    public function store(BannerStoreRequest $request)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            //Banner desktop
            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) {
                $data['path_image'] = $this->pathUpload . $path_image;
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }

            $data['active'] = $request->active ? 1 : 0;

            //Banner mobile
            $path_image_mobile = $helper->renameArchiveUpload($request, 'path_image_mobile');
            if ($path_image_mobile) {
                $data['path_image_mobile'] = $this->pathUpload . $path_image_mobile;
            }
            if ($path_image_mobile) {
                $request->file('path_image_mobile')->storeAs($this->pathUpload, $path_image_mobile);
            }
            if (!Banner::create($data)) {
                Storage::delete($this->pathUpload . $path_image);
                Storage::delete($this->pathUpload . $path_image_mobile);
                throw new Exception();
            }

            Session::flash('success', 'Banner cadastrado com sucesso!');

            DB::commit();
            return redirect()->route('admin.dashboard.banner.index');
        }catch(\Exception $exception){
            // dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar o banner!');
            return redirect()->back();
        }
    }

    public function edit(Banner $banner)
    {
        if (!Auth::user()->can(['banners.visualizar', 'banners.editar'])) {
            return view('Admin.error.403');
        }

        return view('Admin.cruds.banner.edit', [
            'banner' => $banner
        ]);
    }
    public function update(BannerUpdateRequest $request, Banner $banner)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            //Banner desktop
            $path_image = $helper->renameArchiveUpload($request, 'path_image');
            if ($path_image) {
                $data['path_image'] = $this->pathUpload . $path_image;
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
                Storage::delete($banner->path_image);
            }
            if(isset($request->delete_path_image) && !$path_image){
                $inputFile = $request->delete_path_image;
                Storage::delete($banner->$inputFile);
                $data['path_image'] = null;
            }

            //Banner mobile
            $path_image_mobile = $helper->renameArchiveUpload($request, 'path_image_mobile');
            if ($path_image_mobile) {
                $data['path_image_mobile'] = $this->pathUpload . $path_image_mobile;
            }
            if ($path_image_mobile) {
                $request->file('path_image_mobile')->storeAs($this->pathUpload, $path_image_mobile);
                Storage::delete($banner->path_image_mobile);
            }
            if(isset($request->delete_path_image_mobile) && !$path_image_mobile){
                $inputFile = $request->delete_path_image_mobile;
                Storage::delete($banner->$inputFile);
                $data['path_image_mobile'] = null;
            }
            $data['active'] = $request->active ? 1 : 0;

            $banner->fill($data)->save();

            //Banner desktop
            if ($path_image) {
                Storage::delete($this->pathUpload . $path_image);
            }
            if ($path_image) {
                $request->file('path_image')->storeAs($this->pathUpload, $path_image);
            }
            //Banner mobile
            if ($path_image_mobile) {
                Storage::delete($this->pathUpload . $path_image_mobile);
            }
            if ($path_image_mobile) {
                $request->file('path_image_mobile')->storeAs($this->pathUpload, $path_image_mobile);
            }
            DB::commit();
            Session::flash('success', 'Banner atualizado com sucesso!');
            return redirect()->route('admin.dashboard.banner.index');
        }catch(\Exception $exception){
            DB::rollBack();
            Session::flash('error', 'Erro ao atualizar o banner!');
            return redirect()->back();
        }
    }

    public function destroy(Banner $banner)
    {
        if(!Auth::user()->can('banners.remove')){
            return view('Admin.error.403');
        }
        Storage::delete($banner->path_image);
        Storage::delete($banner->path_image_mobile);
        $banner->delete();

        Session::flash('success','Banner deletado com sucesso!');
        return redirect()->back();
    }
    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['banners.visualizar','banners.remove'])) {
            return view('Admin.error.403');
        }

        if($deleted = Banner::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function sorting(Request $request)
    {
        foreach($request->arrId as $sorting => $id){
            Banner::where('id', $id)->update(['sorting' => $sorting]);
        }
        return Response::json(['status' => 'success']);
    }

    public function search(Request $request){
        if(!Auth::user()->can('banners.visualizar')){
            return view('Admin.error.403');
        }

        $banners = Banner::query();

        if ($request->start_date) {
            $banners = $banners->whereDate('start_date', '=', $request->start_date);
        }
        if ($request->end_date) {
            $banners = $banners->where('end_date', '=', $request->end_date);
        }
        if ($request->filled('status')) {
            $banners->where('active', $request->input('status'));
        }
        $banners = $banners->paginate(12);

        return view('Admin.cruds.banner.index', [
            'banners' => $banners,
        ]);
    }
}