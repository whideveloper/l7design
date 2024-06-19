<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\SavGravada;
use App\Exports\LeadExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;

class LeadController extends Controller
{

public function index(Request $request)
{
    if (!Auth::user()->can('lead.visualizar')) {
        return view('Admin.error.403');
    }
    $video_id = $request->video_id;
    $leadsQuery = Lead::query();

    if ($video_id) {
        $leadsQuery->where('video_id', $video_id);
    }

    $leads = $leadsQuery->orderBy('created_at', 'DESC')->paginate(50);

    $videosQuery = SavGravada::join('leads', 'sav_gravadas.id', '=', 'leads.video_id')
    ->active()
    ->select('sav_gravadas.id', 'sav_gravadas.title', 'sav_gravadas.active')
    ->orderBy('sav_gravadas.title', 'asc');

    $videos = $videosQuery->get();

    $videoSelect = [];
    foreach ($videos as $video) {
        $videoSelect[$video->id] = $video->title;
    }

    $leadsCounts = [];
    foreach ($leads as $leadCurrent) {
        $leadsCounts[$leadCurrent->id] = Lead::where('video_id', $leadCurrent->video_id)->count();
    }

    return view('Admin.cruds.leads.index', [
        'leads' => $leads,
        'videoSelect' => $videoSelect,
        'leadsCounts' => $leadsCounts,
        'selectedVideoId' => $video_id,
    ]);
}

    public function show(Lead $lead)
    {   
        return view('Admin.cruds.leads.index',[
            'lead' => $lead,          
        ]);
    }

    public function destroy(Lead $lead)
    {
        if (!Auth::user()->can(['lead.visualizar','lead.remover'])) {
            return view('Admin.error.403');
        }
        $lead->delete();
        Session::flash('success', 'Lead deletado com sucesso!');
        return redirect()->back();
    }
    public function destroySelected(Request $request)
    {
        if (!Auth::user()->can(['lead.visualizar','lead.remover'])) {
            return view('Admin.error.403');
        }

        if($deleted = Lead::whereIn('id', $request->deleteAll)->delete()){
            return Response::json(['status' => 'success', 'message' => $deleted.' itens deletados com sucessso!']);
        }
    }

    public function export() 
    {
        return Excel::download(new LeadExport, 'leads.xlsx');
    }
}
