<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentSubjects;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentsSubjectController extends Controller
{
    public function store(Request $request)
    {
        $subjectId = $request->input('subject_id');
        $studentIds = $request->input('student_id');
        $student = Student::find($studentIds);

        $student->subject()->sync($subjectId);

        activity()
            ->causedBy(auth()->user()) // ou qualquer usuário que causou a ação
            ->performedOn($student)
            ->log('Subject Synced');

        Session::flash('success','Atualização realizada com sucesso!');
        return redirect()->route('admin.dashboard.student.index');
    }

    public function storeSubjectStudent(Request $request)
    {
        $subjectId = $request->input('subject_id');
        $studentIds = $request->input('student_id');
        $subject = Subject::find($subjectId);

        $subject->students()->sync($studentIds);
        activity()
            ->causedBy(auth()->user()) // ou qualquer usuário que causou a ação
            ->performedOn($subject)
            ->log('Student Synced');

        Session::flash('success','Atualização realizada com sucesso!');
        return redirect()->route('admin.dashboard.subject.index');
    }
}
