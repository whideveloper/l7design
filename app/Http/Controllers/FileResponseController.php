<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\HelperArchive;
use App\Models\Course;
use App\Models\File;
use App\Models\FileResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FileResponseController extends Controller
{
    protected $pathUpload = 'admin/uploads/response/file/';
    public function store(Request $request)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            $path_file = $helper->renameArchiveUpload($request, 'path_file');
            if ($path_file) {$data['path_file'] = $this->pathUpload . $path_file;}

            $data['adjusted'] = $request->adjusted ? 1 : 0;
            $data['student_id'] = $request->student_id;

            FileResponse::create($data);

            $file = File::where('id', $request->file_id)->first();

            if ($path_file) {$request->file('path_file')->storeAs($this->pathUpload, $path_file);}
            DB::commit();
            return redirect()
                ->route('admin.dashboard.file.edit', ['file' => $file])
                ->with(Session::flash('success', 'Resposta de atividade cadastrada com sucesso!'));
        }catch(\Exception $exception){
            dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar a atividade!');
            return redirect()->back();
        }
    }
    public function edit(FileResponse $fileResponse){

    }
    public function update(Request $request, FileResponse $fileResponse)
    {
        $data = $request->all();
        $helper = new HelperArchive();

        try {
            DB::beginTransaction();

            $path_file = $helper->renameArchiveUpload($request, 'path_file');
            if ($path_file) {$data['path_file'] = $this->pathUpload . $path_file;}

            $data['adjusted'] = $request->adjusted ? 1 : 0;
//            dd($fileResponse);

            $fileResponse->fill($data)->save();

            $file = File::where('id', $request->file_id)->first();

            if ($path_file) {$request->file('path_file')->storeAs($this->pathUpload, $path_file);}
            DB::commit();
            return redirect()
                ->route('admin.dashboard.file.edit', ['file' => $file])
                ->with(Session::flash('success', 'Status atualizado com sucesso!'));
        }catch(\Exception $exception){
            dd($exception);
            DB::rollBack();
            Session::flash('error', 'Erro ao cadastrar a atividade!');
            return redirect()->back();
        }
    }

}
