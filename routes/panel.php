<?php

use App\Http\Controllers\AuditActivityController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FileResponseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentsSubjectController;
use App\Http\Controllers\SubjectController;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ObjectiveController;
use App\Http\Controllers\TelenordesteController;

Route::get('painel/', function () {
    return redirect()->route('admin.dashboard.painel');
});
Route::prefix('painel/')->group(function () {
    Route::get('/login', function () {
        return view('Admin.auth.login');
    })->name('admin.dashboard.painel');

    Route::post('login.do', [AuthController::class, 'authenticate'])
    ->name('admin.user.authenticate');

    /*=====================REDEFINICAO DE SENHA=========================*/

        // Rota para exibir o formulário "Esqueci a senha"
        Route::get('password/reset', [ForgotPasswordController::class, 'viewForm'])
            ->middleware('guest')->name('password.request');

        // Rota para processar o formulário "Esqueci a senha"
        Route::post('/password/email', function (Request $request) {
            $request->validate(['email' => 'required|email']);
            $status = Password::sendResetLink(
                $request->only('email')
            );

            Session::flash('success', 'Por favor, verifique o seu e-mail para prosseguir com o processo de redefinição de senha.');
            return $status === Password::RESET_LINK_SENT
                        ? back()->with(['status' => __($status)])
                        : back()->withErrors(['email' => __($status)]);
        })->middleware('guest')->name('password.email');

        // Rota para exibir o formulário de redefinição de senha
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->middleware('guest')->name('password.reset');

        // Rota para processar a redefinição de senha
        Route::post('/password/reset', function (Request $request) {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
            ]);

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            Session::flash('success', 'Senha alterada com sucesso!');
            return $status === Password::PASSWORD_RESET
                        ? redirect()->route('admin.dashboard.painel')->with('status', __($status))
                        : back()->withErrors(['email' => [__($status)]]);
        })->middleware('guest')->name('password.update');

    /*=====================FINAL REDEFINICAO DE SENHA=========================*/

    Route::middleware('auth')->group(function(){
        Route::get('/carregamento', function () {
            return view('Admin.loadPage.login');
        })->name('loading');

        Route::get('/dashboard', function () {
            return view('Admin.dashboard');
        })->name('admin.dashboard');

        //BANNER
        Route::resource('banner', BannerController::class)
            ->names('admin.dashboard.banner')
            ->parameters(['banner' => 'banner']);
        Route::post('banner/delete', [BannerController::class, 'destroySelected'])
            ->name('admin.dashboard.banner.destroySelected');
        Route::post('banner/sorting', [BannerController::class, 'sorting'])
            ->name('admin.dashboard.banner.sorting');            
        //SEARCH BANNER
        Route::post('banner/search', [BannerController::class, 'search'])
        ->name('admin.dashboard.banner-search');
        //TELENORDESTE
        Route::resource('telenordeste', TelenordesteController::class)
            ->names('admin.dashboard.telenordeste')
            ->parameters(['telenordeste' => 'telenordeste']);
        Route::post('telenordeste/delete', [TelenordesteController::class, 'destroySelected'])
            ->name('admin.dashboard.telenordeste.destroySelected');
        Route::post('telenordeste/sorting', [TelenordesteController::class, 'sorting'])
            ->name('admin.dashboard.telenordeste.sorting');
        //LOCALIZACAO
        Route::resource('localizacao', LocationController::class)
            ->names('admin.dashboard.location')
            ->parameters(['localizacao' => 'location']);
        Route::post('localizacao/delete', [LocationController::class, 'destroySelected'])
            ->name('admin.dashboard.location.destroySelected');
        Route::post('localizacao/sorting', [LocationController::class, 'sorting'])
            ->name('admin.dashboard.location.sorting');
        //OBJETIVO
        Route::resource('objetivo', ObjectiveController::class)
            ->names('admin.dashboard.objective')
            ->parameters(['objetivo' => 'objective']);
        Route::post('objetivo/delete', [ObjectiveController::class, 'destroySelected'])
            ->name('admin.dashboard.objective.destroySelected');
        Route::post('objetivo/sorting', [ObjectiveController::class, 'sorting'])
            ->name('admin.dashboard.objective.sorting');
        
        
        //AUDITORIA
        Route::resource('auditoria', AuditActivityController::class)
            ->names('admin.dashboard.audit')
            ->parameters(['auditoria'=>'activitie']);

        //CURSOS
        Route::resource('cursos', CourseController::class)
            ->names('admin.dashboard.course')
            ->parameters(['cursos' => 'course']);
        Route::post('cursos/delete', [CourseController::class, 'destroySelected'])
            ->name('admin.dashboard.course.destroySelected');
        Route::post('cursos/sorting', [CourseController::class, 'sorting'])
            ->name('admin.dashboard.course.sorting');

        //ATIVIDADE
        Route::resource('atividades', FileController::class)
            ->names('admin.dashboard.file')
            ->parameters(['atividades' => 'file']);
        Route::post('atividades/delete', [FileController::class, 'destroySelected'])
            ->name('admin.dashboard.file.destroySelected');
        Route::post('atividades/sorting', [FileController::class, 'sorting'])
            ->name('admin.dashboard.file.sorting');

        //RESPOSTA DA ATIVIDADE
        Route::resource('atividades/resposta', FileResponseController::class)
            ->names('admin.dashboard.response')
            ->parameters(['atividades/resposta' => 'fileResponse']);
        Route::post('atividades/resposta/delete', [FileResponseController::class, 'destroySelected'])
            ->name('admin.dashboard.response.destroySelected');
        Route::post('atividades/resposta/sorting', [FileResponseController::class, 'sorting'])
            ->name('admin.dashboard.response.sorting');


        //GRUPOS
        Route::resource('grupos', RoleController::class)
        ->names('admin.dashboard.group')
        ->parameters(['grupos' => 'role']);
        Route::post('grupos/delete', [RoleController::class, 'destroySelected'])
            ->name('admin.dashboard.group.destroySelected');
        Route::post('grupos/sorting', [RoleController::class, 'sorting'])
            ->name('admin.dashboard.group.sorting');

        //MATERIAS
        Route::resource('materias', SubjectController::class)
            ->names('admin.dashboard.subject')
            ->parameters(['materias' => 'subject']);
        //SHOW
        Route::get('materias/deletados/show', [SubjectController::class, 'deletedShow'])
            ->name('admin.dashboard.subject.show');
//        Route::get('materias/adicionar-aluno-a-materia/{subject}', [SubjectController::class, 'addStudentSubject'])
//            ->name('admin.dashboard.subject.addStudentSubject');
        Route::post('materias/deletados/show/search', [SubjectController::class, 'search'])
            ->name('admin.dashboard.subject.show.search');
        Route::post('materias/deletados/show/delete', [SubjectController::class, 'destroySelectedForced'])
            ->name('admin.dashboard.subject.destroySelectedForced');
        //RESTORE
        Route::post('materias/retoreData/{subject}', [SubjectController::class, 'retoreData'])
            ->name('admin.dashboard.subject.retoreData');
        Route::post('materias/restore', [SubjectController::class, 'retoreDataAll'])
            ->name('admin.dashboard.subject.retoreDataAll');
        //DELETADOS
        Route::delete('materias/deleteForced/{subject}', [SubjectController::class, 'deleteForced'])
            ->name('admin.dashboard.subject.deleteForced');
        Route::post('materias/delete', [SubjectController::class, 'destroySelected'])
            ->name('admin.dashboard.subject.destroySelected');
        Route::post('materias/sorting', [SubjectController::class, 'sorting'])
            ->name('admin.dashboard.subject.sorting');

        //ALUNOS
        Route::resource('alunos', StudentController::class)
            ->names('admin.dashboard.student')
            ->parameters(['alunos' => 'student']);
        Route::post('/alunos/disciplina', [StudentsSubjectController::class, 'store'])
            ->name('admin.dashboard.studentSubject');
        Route::post('/alunos/disciplina/aluno', [StudentsSubjectController::class, 'storeSubjectStudent'])
            ->name('admin.dashboard.subjectStudent');
        //SHOW
        Route::get('alunos/deletados/show', [StudentController::class, 'deletedShow'])
            ->name('admin.dashboard.student.show');
        Route::post('alunos/deletados/show/search', [StudentController::class, 'search'])
            ->name('admin.dashboard.student.show.search');
        Route::post('alunos/deletados/show/delete', [StudentController::class, 'destroySelectedForced'])
            ->name('admin.dashboard.student.destroySelectedForced');
        //RESTORE
        Route::post('alunos/retoreData/{student}', [StudentController::class, 'retoreData'])
            ->name('admin.dashboard.student.retoreData');
        Route::post('alunos/restore', [StudentController::class, 'retoreDataAll'])
            ->name('admin.dashboard.student.retoreDataAll');
        //DELETADOS
        Route::delete('alunos/deleteForced/{student}', [StudentController::class, 'deleteForced'])
            ->name('admin.dashboard.student.deleteForced');
        Route::post('alunos/delete', [StudentController::class, 'destroySelected'])
            ->name('admin.dashboard.student.destroySelected');
        Route::post('alunos/sorting', [StudentController::class, 'sorting'])
            ->name('admin.dashboard.student.sorting');

        //USUARIOS
        Route::resource('usuario', UserController::class)
            ->names('admin.dashboard.user')
            ->parameters(['usuario'=>'user']);
        //SHOW
        Route::get('usuario/deletados/showDeleted', [UserController::class, 'deletedShow'])
            ->name('admin.dashboard.user.showDeleted');
        Route::post('usuario/deletados/show/search', [UserController::class, 'search'])
        ->name('admin.dashboard.user.show.search');
        Route::post('usuario/deletados/show/delete', [UserController::class, 'destroySelectedForced'])
        ->name('admin.dashboard.user.destroySelectedForced');
        //RESTORE
        Route::post('usuario/retoreData/{user}', [UserController::class, 'retoreData'])
            ->name('admin.dashboard.user.retoreData');
        Route::post('usuario/restore', [UserController::class, 'retoreDataAll'])
            ->name('admin.dashboard.user.retoreDataAll');
        //DELETADOS
        Route::delete('usuario/deleteForced/{user}', [UserController::class, 'deleteForced'])
            ->name('admin.dashboard.user.deleteForced');
        Route::post('usuario/delete', [UserController::class, 'destroySelected'])
            ->name('admin.dashboard.user.destroySelected');
        Route::post('usuario/sorting', [UserController::class, 'sorting'])
            ->name('admin.dashboard.user.sorting');

        //CONTATO
        Route::resource('contato', ContactController::class)
            ->names('admin.dashboard.contact')
            ->parameters(['contato'=>'contact']);
        Route::post('contato/delete', [ContactController::class, 'destroySelected'])
            ->name('admin.dashboard.contact.destroySelected');
        Route::post('contato/sorting', [ContactController::class, 'sorting'])
            ->name('admin.dashboard.contact.sorting');
        Route::post('contato/search', [ContactController::class, 'index'])
            ->name('admin.dashboard.contact.search');

        // LOGOUT
        Route::get('logout', [AuthController::class, 'logout'])->name('admin.dashboard.user.logout');
    });
});

View::composer('Admin.core.admin', function ($view) {
    $user = User::where('id', Auth::user()->id)->first();
    return $view->with('user', $user);
});
