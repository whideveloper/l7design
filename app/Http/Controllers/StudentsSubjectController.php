<?php

namespace App\Http\Controllers;

use App\Models\StudentSubjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentsSubjectController extends Controller
{
    public function store(Request $request)
    {
        $subject = StudentSubjects::where('student_id', $request->student_id)->delete();

        if ($request->subject_id) {
            foreach($request->subject_id as $subject){
                StudentSubjects::create([
                    'subject_id' => $subject,
                    'student_id' => $request->student_id
                ]);
            }
        }
        Session::flash('success','Atualização realizada com sucesso!');
        return redirect()->route('admin.dashboard.student.index');
    }

    public function storeSubjectStudent(Request $request)
    {

        $student = StudentSubjects::where('subject_id', $request->subject_id)->delete();

        if ($request->student_id) {
            foreach($request->student_id as $student){
                StudentSubjects::create([
                    'subject_id' => $request->subject_id,
                    'student_id' => $student
                ]);
            }
        }
        Session::flash('success','Atualização realizada com sucesso!');
        return redirect()->route('admin.dashboard.subject.index');
    }
}
