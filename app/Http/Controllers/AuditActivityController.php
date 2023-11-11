<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use App\Enums\ModelTypeAudit;


class AuditActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::orderBy('created_at', 'DESC')->paginate(10);

        return view('Admin.cruds.audit.index', [
            'activities' => $activities
        ]);
    }

    public function show(Activity $activitie)
    {

        return view('Admin.cruds.audit.show')->with([
            'activitie'=>$activitie
        ]);
    }
}
