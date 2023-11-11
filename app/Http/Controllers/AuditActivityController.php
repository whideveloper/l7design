<?php

namespace App\Http\Controllers;

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
        $activities = Activity::join('users', 'activity_log.causer_id', 'users.id')
            ->select([
                'activity_log.id',
                'activity_log.description',
                'activity_log.subject_type',
                'activity_log.subject_id',
                'activity_log.causer_id',
                'activity_log.updated_at',
                'activity_log.created_at',
                'users.id',
                'users.name'
            ])
            ->orderBy('created_at', 'DESC')->paginate(10);

        return view('Admin.cruds.audit.index', [
            'activities' => $activities
        ]);
    }

    public function show(Activity $activitie)
    {
        if(!Auth::user()->can('auditoria.visualizar')){
            return view('Admin.error.403');
        }
        $userName = Activity::join('users', 'activity_log.causer_id', 'users.id')
            ->select([
                'activity_log.id',
                'activity_log.description',
                'activity_log.subject_type',
                'activity_log.subject_id',
                'activity_log.causer_id',
                'activity_log.updated_at',
                'activity_log.created_at',
                'users.id',
                'users.name'
            ])
            ->where('activity_log.causer_id', $activitie->id)
            ->first();
        return view('Admin.cruds.audit.show')->with([
            'activitie'=>$activitie,
            'userName' => $userName
        ]);
    }
}
