<?php

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SavController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ProadiController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProtocolController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\DepoimentController;
use App\Http\Controllers\HowItWorkController;
use App\Http\Controllers\ObjectiveController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\GoogleFormController;
use App\Http\Controllers\SavGravadaController;
use App\Http\Controllers\StepToStepController;
use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\GalleryImageController;
use App\Http\Controllers\MuralDeApoioController;
use App\Http\Controllers\TelenordesteController;
use App\Http\Controllers\AuditActivityController;
use App\Http\Controllers\Client\SavPageController;
use App\Http\Controllers\TrainingForUseController;
use App\Http\Controllers\MaterialDocumentController;
use App\Http\Controllers\TeleinterconsultaController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ContactTelenordesteController;
use App\Http\Controllers\EspecialidadeSessionController;
use App\Http\Controllers\EspecialidadeCategoryController;
use App\Http\Controllers\MuralDeComunicacaoFeedController;
use App\Http\Controllers\EspecialidadeProfessionalController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\MuralDeComunicacaoCategoryController;

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

        Route::get('/videos-tutorial', function () {
            return view('Admin.cruds.videoTutorial.index');
        })->name('admin.dashboard.videoTutorial');

        //BANNER
        Route::resource('banner', BannerController::class)
            ->names('admin.dashboard.banner')
            ->parameters(['banner' => 'banner']);
        Route::post('banner/delete', [BannerController::class, 'destroySelected'])
            ->name('admin.dashboard.banner.destroySelected');
        Route::post('banner/sorting', [BannerController::class, 'sorting'])
            ->name('admin.dashboard.banner.sorting');            
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
        Route::post('objetivo/sorting', [ObjectiveController::class, 'sorting'])
            ->name('admin.dashboard.objective.sorting');
         //TELEINTERCONSULTA
         Route::resource('teleinterconsulta', TeleinterconsultaController::class)
         ->names('admin.dashboard.teleinterconsulta')
         ->parameters(['teleinterconsulta' => 'teleinterconsulta']);
        Route::post('teleinterconsulta/delete', [TeleinterconsultaController::class, 'destroySelected'])
            ->name('admin.dashboard.teleinterconsulta.destroySelected');
        Route::post('teleinterconsulta/sorting', [TeleinterconsultaController::class, 'sorting'])
            ->name('admin.dashboard.teleinterconsulta.sorting');
         //COMO FUNCIONA
         Route::resource('como-funciona', HowItWorkController::class)
         ->names('admin.dashboard.howItWork')
         ->parameters(['como-funciona' => 'howItWork']);
         Route::post('como-funciona/delete', [HowItWorkController::class, 'destroySelected'])
            ->name('admin.dashboard.howItWork.destroySelected');
        //PASSO-A-PASSO
        Route::resource('passo-a-passo', StepToStepController::class)
        ->names('admin.dashboard.stepToStep')
        ->parameters(['passo-a-passo' => 'stepToStep']);
        Route::post('passo-a-passo/delete', [StepToStepController::class, 'destroySelected'])
           ->name('admin.dashboard.stepToStep.destroySelected');
        Route::post('passo-a-passo/sorting', [StepToStepController::class, 'sorting'])
           ->name('admin.dashboard.stepToStep.sorting');
        //HOSPITAL
        Route::resource('hospital', HospitalController::class)
        ->names('admin.dashboard.hospital')
        ->parameters(['hospital' => 'hospital']);
        Route::post('hospital/delete', [HospitalController::class, 'destroySelected'])
           ->name('admin.dashboard.hospital.destroySelected');
        //PROADI
        Route::resource('proadi', ProadiController::class)
        ->names('admin.dashboard.proadi')
        ->parameters(['proadi' => 'proadi']);
        Route::post('proadi/delete', [ProadiController::class, 'destroySelected'])
           ->name('admin.dashboard.proadi.destroySelected');
        //DEPOIMENTO
        Route::resource('depoimento', DepoimentController::class)
            ->names('admin.dashboard.depoiment')
            ->parameters(['depoimento' => 'depoiment']);
        Route::post('depoimento/delete', [DepoimentController::class, 'destroySelected'])
            ->name('admin.dashboard.depoiment.destroySelected');
        Route::post('depoimento/sorting', [DepoimentController::class, 'sorting'])
            ->name('admin.dashboard.depoiment.sorting');
        //PARCEIROS
        Route::resource('parceiros', PartnerController::class)
            ->names('admin.dashboard.partner')
            ->parameters(['parceiros' => 'partner']);
        Route::post('parceiros/delete', [PartnerController::class, 'destroySelected'])
            ->name('admin.dashboard.partner.destroySelected');
        Route::post('parceiros/sorting', [PartnerController::class, 'sorting'])
            ->name('admin.dashboard.partner.sorting');

        //CATEGORIA ESPECIALIDADE
        Route::resource('categoria-especialidade', EspecialidadeCategoryController::class)
            ->names('admin.dashboard.especialidadeCategory')
            ->parameters(['categoria-especialidade' => 'especialidadeCategory']);
        Route::post('categoria-especialidade/delete', [EspecialidadeCategoryController::class, 'destroySelected'])
            ->name('admin.dashboard.especialidadeCategory.destroySelected');
        Route::post('categoria-especialidade/sorting', [EspecialidadeCategoryController::class, 'sorting'])
            ->name('admin.dashboard.especialidadeCategory.sorting');

        //SESSAO ESPECIALIDADE
        Route::resource('especialidade', EspecialidadeSessionController::class)
            ->names('admin.dashboard.especialidadeSession')
            ->parameters(['especialidade' => 'especialidadeSession']);

        //ESPECIALIDADE
        Route::resource('profissionais', EspecialidadeProfessionalController::class)
            ->names('admin.dashboard.especialidadeProfessional')
            ->parameters(['profissionais' => 'especialidadeProfessional']);
        Route::post('profissionais/delete', [EspecialidadeProfessionalController::class, 'destroySelected'])
            ->name('admin.dashboard.especialidadeProfessional.destroySelected');
        Route::post('profissionais/sorting', [EspecialidadeProfessionalController::class, 'sorting'])
            ->name('admin.dashboard.especialidadeProfessional.sorting');
        Route::post('profissionais/desativa-sessao', [EspecialidadeProfessionalController::class, 'desactiveSession'])
            ->name('admin.dashboard.especialidadeProfessional.desactiveSession');
        Route::post('profissionais/ativa-sessao', [EspecialidadeProfessionalController::class, 'activeSession'])
            ->name('admin.dashboard.especialidadeProfessional.activeSession');

        //TUTORIAL
        Route::resource('tutorial', TutorialController::class)
        ->names('admin.dashboard.tutorial')
        ->parameters(['tutorial' => 'tutorial']); 
        
        //MURAL DE APOIO
        Route::resource('sessao-mural-de-comunicacao', MuralDeApoioController::class)
        ->names('admin.dashboard.muralDeApoio')
        ->parameters(['sessao-mural-de-comunicacao' => 'muralDeApoio']); 

        //CATEGORIA MURAL DE COMUNICACAO
        Route::resource('categoria-mural-de-comunicacao', MuralDeComunicacaoCategoryController::class)
            ->names('admin.dashboard.muralDeComunicacaoCategory')
            ->parameters(['categoria-mural-de-comunicacao' => 'muralDeComunicacaoCategory']);
        Route::post('categoria-mural-de-comunicacao/delete', [MuralDeComunicacaoCategoryController::class, 'destroySelected'])
            ->name('admin.dashboard.muralDeComunicacaoCategory.destroySelected');
        Route::post('categoria-mural-de-comunicacao/sorting', [MuralDeComunicacaoCategoryController::class, 'sorting'])
            ->name('admin.dashboard.muralDeComunicacaoCategory.sorting');

        // MURAL DE COMUNICACAO
        Route::resource('mural-de-comunicacao', MuralDeComunicacaoFeedController::class)
        ->names('admin.dashboard.muralDeComunicacaoFeed')
        ->parameters(['mural-de-comunicacao' => 'muralDeComunicacaoFeed']); 
        Route::post('mural-de-comunicacao/delete', [MuralDeComunicacaoFeedController::class, 'destroySelected'])
            ->name('admin.dashboard.muralDeComunicacaoFeed.destroySelected');
        Route::post('mural-de-comunicacao/sorting', [MuralDeComunicacaoFeedController::class, 'sorting'])
            ->name('admin.dashboard.muralDeComunicacaoFeed.sorting');
        
        //TREINAMENTO
        Route::resource('treinamento', TrainingForUseController::class)
        ->names('admin.dashboard.trainingForUse')
        ->parameters(['treinamento' => 'trainingForUse']); 

        //ARQUIVO DE TREINAMENTO
        Route::resource('arquivo-de-treinamento', TrainingController::class)
        ->names('admin.dashboard.training')
        ->parameters(['arquivo-de-treinamento' => 'training']); 
        Route::post('arquivo-de-treinamento/delete', [TrainingController::class, 'destroySelected'])
            ->name('admin.dashboard.training.destroySelected');
        Route::post('arquivo-de-treinamento/sorting', [TrainingController::class, 'sorting'])
            ->name('admin.dashboard.training.sorting');

        //TREINAMENTO
        Route::resource('protocolo', ProtocolController::class)
        ->names('admin.dashboard.protocol')
        ->parameters(['protocolo' => 'protocol']); 

        //ARQUIVO DE TREINAMENTO
        Route::resource('material-de-apoio', MaterialController::class)
        ->names('admin.dashboard.material')
        ->parameters(['material-de-apoio' => 'material']); 
        Route::post('material-de-apoio/delete', [MaterialController::class, 'destroySelected'])
            ->name('admin.dashboard.material.destroySelected');
        Route::post('material-de-apoio/sorting', [MaterialController::class, 'sorting'])
            ->name('admin.dashboard.material.sorting');

        //DOCUMENTO DE MATERIAL DE APOIO
        Route::resource('documento-material-de-apoio', MaterialDocumentController::class)
        ->names('admin.dashboard.materialDocument')
        ->parameters(['documento-material-de-apoio' => 'materialDocument']); 
        Route::post('documento-material-de-apoio/delete', [MaterialDocumentController::class, 'destroySelected'])
            ->name('admin.dashboard.materialDocument.destroySelected');
        Route::post('documento-material-de-apoio/sorting', [MaterialDocumentController::class, 'sorting'])
            ->name('admin.dashboard.materialDocument.sorting');

        //AGENDAMENTO
        Route::resource('agendamento', AgendamentoController::class)
            ->names('admin.dashboard.agendamento')
            ->parameters(['agendamento'=>'agendamento']);
        
        //SAV
        Route::resource('sav', SavController::class)
        ->names('admin.dashboard.sav')
        ->parameters(['sav' => 'sav']);
        
        //SAV GRAVADA
        Route::resource('sav-gravada', SavGravadaController::class)
        ->names('admin.dashboard.savGravada')
        ->parameters(['sav-gravada' => 'savGravada']); 
        Route::post('sav-gravada/delete', [SavGravadaController::class, 'destroySelected'])
            ->name('admin.dashboard.savGravada.destroySelected');
        Route::post('sav-gravada/sorting', [SavGravadaController::class, 'sorting'])
            ->name('admin.dashboard.savGravada.sorting');

        //LEADS
        Route::resource('leads', LeadController::class)
        ->names('admin.dashboard.lead')
        ->parameters(['leads' => 'lead']);
        Route::post('leads/delete', [LeadController::class, 'destroySelected'])
            ->name('admin.dashboard.lead.destroySelected');
        Route::get('lead-search', [LeadController::class, 'index'])
            ->name('admin.dashboard.lead.lead-search');

        //GRUPOS
        Route::resource('contato-telenordeste', ContactTelenordesteController::class)
        ->names('admin.dashboard.contactTelenordeste')
        ->parameters(['contato-telenordeste' => 'contactTelenordeste']);
        Route::post('contato-telenordeste/delete', [ContactTelenordesteController::class, 'destroySelected'])
            ->name('admin.dashboard.contactTelenordeste.destroySelected');
        Route::post('contato-telenordeste/sorting', [ContactTelenordesteController::class, 'sorting'])
            ->name('admin.dashboard.contactTelenordeste.sorting');
        //GALRIA
        Route::resource('galeria', GalleryController::class)
        ->names('admin.dashboard.gallery')
        ->parameters(['galeria' => 'gallery']);
        Route::post('galeria/delete', [GalleryController::class, 'destroySelected'])
            ->name('admin.dashboard.gallery.destroySelected');
        Route::post('galeria/sorting', [GalleryController::class, 'sorting'])
            ->name('admin.dashboard.gallery.sorting');
        //GALRIA IMAGEM
        Route::resource('imagem-galeria', GalleryImageController::class)
        ->names('admin.dashboard.galleryImage')
        ->parameters(['imagem-galeria' => 'galleryImage']);
        Route::post('imagem-galeria/delete', [GalleryImageController::class, 'destroySelected'])
            ->name('admin.dashboard.galleryImage.destroySelected');
        Route::post('imagem-galeria/sorting', [GalleryImageController::class, 'sorting'])
            ->name('admin.dashboard.galleryImage.sorting');
        //EVENTO
        Route::resource('evento', EventController::class)
        ->names('admin.dashboard.event')
        ->parameters(['evento' => 'event']);
        Route::post('evento/delete', [EventController::class, 'destroySelected'])
            ->name('admin.dashboard.event.destroySelected');
        Route::post('evento/sorting', [EventController::class, 'sorting'])
            ->name('admin.dashboard.event.sorting');
        //FERIADO
        Route::resource('feriados', HolidayController::class)
        ->names('admin.dashboard.holiday')
        ->parameters(['feriados' => 'holiday']);
        Route::post('feriados/delete', [HolidayController::class, 'destroySelected'])
            ->name('admin.dashboard.holiday.destroySelected');
        Route::post('feriados/sorting', [HolidayController::class, 'sorting'])
            ->name('admin.dashboard.holiday.sorting');
        //MAPA
        Route::resource('mapa', MapController::class)
        ->names('admin.dashboard.map')
        ->parameters(['mapa' => 'map']);
        Route::post('mapa/delete', [MapController::class, 'destroySelected'])
            ->name('admin.dashboard.map.destroySelected');
        Route::post('mapa/sorting', [MapController::class, 'sorting'])
            ->name('admin.dashboard.map.sorting');
        //SESSAO FORMULARIO
        Route::resource('sessao-formulario', GoogleFormController::class)
            ->names('admin.dashboard.googleForm')
            ->parameters(['sessao-formulario'=>'googleForm']);
        
        //AUDITORIA
        Route::resource('auditoria', AuditActivityController::class)
            ->names('admin.dashboard.audit')
            ->parameters(['auditoria'=>'activitie']);
        //GRUPOS
        Route::resource('grupos', RoleController::class)
        ->names('admin.dashboard.group')
        ->parameters(['grupos' => 'role']);
        Route::post('grupos/delete', [RoleController::class, 'destroySelected'])
            ->name('admin.dashboard.group.destroySelected');
        Route::post('grupos/sorting', [RoleController::class, 'sorting'])
            ->name('admin.dashboard.group.sorting');
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
Route::post('lead', [SavPageController::class, 'leadSave'])
->name('admin.dashboard.lead.leadSave');

View::composer('Admin.core.admin', function ($view) {
    $user = User::where('id', Auth::user()->id)->first();
    return $view->with('user', $user);
});
