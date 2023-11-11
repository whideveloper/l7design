<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use App\Enums\ModelTypeAudit;


class AuditActivityController extends Controller
{
    public function index()
    {
        if(!Auth::user()->can('auditoria.visualizar')){
            return view('Admin.error.403');
        }

        $activities = Activity::with('causer')->orderBy('created_at', 'DESC')
            ->paginate(10);
        return view('Admin.cruds.audit.index', [
            'activities' => $activities,
        ]);
    }

    public function show(Activity $activitie)
    {
        if(!Auth::user()->can('auditoria.visualizar')){
            return view('Admin.error.403');
        }
        return view('Admin.cruds.audit.show')->with([
            'activitie'=>$activitie,
        ]);
    }
}
