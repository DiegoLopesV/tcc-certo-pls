<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SolicitacoesController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OcorrenciasController;
use App\Http\Controllers\AlunosController;
use App\Http\Controllers\EnfermariaController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GraficoController;
use App\Http\Controllers\ResetPasswordController;
use App\Models\Ocorrencias;

Route::get('send-mail', [MailController::class, 'index']);

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function () {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get(
            "/produtos",
            "ProdutosController@index"
        )->name("produtos.index");
        Route::get(
            "/produtos/create",
            "ProdutosController@create"
        )->name("produtos.create");
        Route::post(
            "/produtos/create",
            "ProdutosController@store"
        )->name("produtos.store");
        Route::delete('/produtos/{produto}/delete', 'ProdutosController@destroy')->name('produtos.destroy');
        Route::get('/produtos/{produto}/show', 'ProdutosController@show')->name('produtos.show');
        Route::get('/produtos/{produto}/edit', 'ProdutosController@edit')->name('produtos.edit');
        Route::patch('/produtos/{produto}/update', 'ProdutosController@update')->name('produtos.update');

        Route::get("/usuarios", "UsuariosController@index")->name("usuarios.index");
        Route::get("/usuarios/create", "UsuariosController@create")->name("usuarios.create");
        Route::post("/usuarios/create", "UsuariosController@store")->name("usuarios.store");
        Route::delete('/usuarios/{user}/delete', 'UsuariosController@destroy')->name('usuarios.destroy');
        Route::get('/usuarios/{user}/show', 'UsuariosController@show')->name('usuarios.show');
        Route::get('/usuarios/{user}/edit', 'UsuariosController@edit')->name('usuarios.edit');
        Route::patch('/usuarios/{user}/update', 'UsuariosController@update')->name('usuarios.update');
        Route::get("/usuarios/pdf", "UserPDFController@gerarPDF")->name("usuarios.pdf");

        Route::get('/professores', 'ProfessoresController@index')->name('professores.index');
        Route::get('/professores/{professor}/mail', 'MailController@index')->name('professoresMail.index');
        Route::get('/professores/create', 'ProfessoresController@create')->name('professores.create');
        Route::post('/professores/create', 'ProfessoresController@store')->name('professores.store');
        Route::get('/professores/{professor}/show', 'ProfessoresController@show')->name('professores.show');
        Route::get('/professores/{professor}/edit', 'ProfessoresController@edit')->name('professores.edit');
        Route::patch('/professores/{professor}/update', 'ProfessoresController@update')->name('professores.update');
        Route::delete('/professores/{professor}/delete', 'ProfessoresController@destroy')->name('professores.destroy');

        Route::get('/disciplinas', 'DisciplinasController@index')->name('disciplinas.index');
        Route::get('/disciplinas/create', 'DisciplinasController@create')->name('disciplinas.create');
        Route::post('/disciplinas/create', 'DisciplinasController@store')->name('disciplinas.store');
        Route::get('/disciplinas/{disciplina}/show', 'DisciplinasController@show')->name('disciplinas.show');
        Route::get('/disciplinas/{disciplina}/edit', 'DisciplinasController@edit')->name('disciplinas.edit');
        Route::patch('/disciplinas/{disciplina}/update', 'DisciplinasController@update')->name('disciplinas.update');
        Route::delete('/disciplinas/{disciplina}/delete', 'DisciplinasController@destroy')->name('disciplinas.destroy');
        Route::get("/disciplinas/{professor_id}/pdf", "DisciplinaPDFController@gerarPDF")->name("disciplinas.pdf");
        /*
            Route::get('/disciplinasProfessores', 'DisciplinasProfessoresController@index')->name('disciplinasProfessores.index');
            Route::get('/disciplinasProfessores/create', 'DisciplinasProfessoresController@create')->name('disciplinasProfessores.create');
            Route::post('/disciplinasProfessores/create', 'DisciplinasProfessoresController@store')->name('disciplinasProfessores.store');
            Route::get('/disciplinasProfessores/{disciplinasProfessores}/show', 'DisciplinasProfessoresController@show')->name('disciplinasProfessores.show');
            Route::get('/disciplinasProfessores/{disciplinasProfessores}/edit', 'DisciplinasProfessoresController@edit')->name('disciplinasProfessores.edit');
            Route::patch('/disciplinasProfessores/{disciplinasProfessores}/update', 'DisciplinasProfessoresController@update')->name('disciplinasProfessores.update');
            Route::delete('/disciplinasProfessores/{disciplinasProfessores}/delete', 'DisciplinasProfessoresController@destroy')->name('disciplinasProfessores.destroy');
            Route::get("/disciplinasProfessores/pdf", "DisciplinaProfessorPDFController@gerarPDF")->name("disciplinasProfessores.pdf");
            */

        //Filtro Ocorrências
        Route::get('/filtro/{turma}', [OcorrenciasController::class, 'filtro'])->name('ocorrencias.filtro');

        //Rotas da Enfermaria
        Route::get("/enfermaria", "EnfermariaController@index")->name("enfermaria.index");

        //Rotas das Mensagens
        Route::get("/mensagens", "MensagensController@index")->name("mensagens.index");

        //Rotas Perfil
        Route::get("/perfil", "PerfilController@index")->name("perfil.index");

        // Rota Petroleo é Gás
        Route::get('/pg', function () {
            return view('layouts.partials.pg');
        })->name('pg');

        //Rota Info
        Route::get('/info', function () {
            return view('layouts.partials.info');
        })->name('info');

        //Rota ADM
        Route::get('/adm', function () {
            return view('layouts.partials.adm');
        })->name('adm');

        //Rota Eletrônica
        Route::get('/elet', function () {
            return view('layouts.partials.elet');
        })->name('elet');

        //Rota Mecânica
        Route::get('/mec', function () {
            return view('layouts.partials.mec');
        })->name('mec');

        //Rota Contabilidade
        Route::get('/cont', function () {
            return view('layouts.partials.cont');
        })->name('cont');

        //Rota Jogos
        Route::get('/jogos', function () {
            return view('layouts.partials.jogos');
        })->name('jogos');

        //Rota PF
        Route::get('/pf', function () {
            return view('layouts.partials.pf');
        })->name('pf');

        //rota info turmas
        Route::get('/turma/{id}', [InfoController::class, 'show']);

        //Solicitações
        Route::resource(
            "/solicitacoes",
            SolicitacoesController::class
        );
        //Dependências 
        Route::get('/dependencias', function () {
            return view('layouts.partials.dependencias');
        })->name('dependencias');

        //Rotas Alunos
        Route::get('/alunos', [AlunosController::class, 'index'])->name('alunos.index');
        Route::get('/alunos/create', [AlunosController::class, 'create'])->name('alunos.create');
        Route::post('/alunos/create', [AlunosController::class, 'store'])->name('alunos.store');
        Route::get('/alunos/{id}/edit', [AlunosController::class, 'edit'])->name('alunos.edit');
        Route::put('/alunos/{id}', [AlunosController::class, 'update'])->name('alunos.update');
        Route::delete('/alunos/{id}', [AlunosController::class, 'destroy'])->name('alunos.destroy');
        Route::get('/info1', [AlunosController::class, 'showInfo1'])->name('info1');
        Route::get('/info2', [AlunosController::class, 'showInfo2'])->name('info2');
        Route::get('/info3', [AlunosController::class, 'showInfo3'])->name('info3');
        Route::get('/info4', [AlunosController::class, 'showInfo4'])->name('info4');
        Route::get('/pg1', [AlunosController::class, 'showPg1'])->name('pg1');
        Route::get('/pg2', [AlunosController::class, 'showPg2'])->name('pg2');
        Route::get('/pg3', [AlunosController::class, 'showPg3'])->name('pg3');
        Route::get('/adm1', [AlunosController::class, 'showAdm1'])->name('adm1');
        Route::get('/adm2', [AlunosController::class, 'showAdm2'])->name('adm2');
        Route::get('/adm3', [AlunosController::class, 'showAdm3'])->name('adm3');
        Route::get('/elet1', [AlunosController::class, 'showElet1'])->name('elet1');
        Route::get('/elet2', [AlunosController::class, 'showElet2'])->name('elet2');
        Route::get('/elet3', [AlunosController::class, 'showElet3'])->name('elet3');
        Route::get('/mec1', [AlunosController::class, 'showMec1'])->name('mec1');
        Route::get('/mec2', [AlunosController::class, 'showMec2'])->name('mec2');
        Route::get('/mec3', [AlunosController::class, 'showMec3'])->name('mec3');
        Route::get('/cont1', [AlunosController::class, 'showCont1'])->name('cont1');
        Route::get('/cont2', [AlunosController::class, 'showCont2'])->name('cont2');
        Route::get('/cont3', [AlunosController::class, 'showCont3'])->name('cont3');
        Route::get('/jogos1', [AlunosController::class, 'showJogos1'])->name('jogos1');
        Route::get('/jogos2', [AlunosController::class, 'showJogos2'])->name('jogos2');
        Route::get('/jogos3', [AlunosController::class, 'showJogos3'])->name('jogos3');
        Route::get('/jogos4', [AlunosController::class, 'showJogos4'])->name('jogos4');
        Route::get('/pf1', [AlunosController::class, 'showPf1'])->name('pf1');
        Route::get('/pf2', [AlunosController::class, 'showPf2'])->name('pf2');
        Route::get('/pf3', [AlunosController::class, 'showPf3'])->name('pf3');
        Route::resource('alunos', AlunosController::class);
        Route::put('/alunos/{id}', [AlunosController::class, 'update']);
        Route::post('/alunos', [AlunosController::class, 'store']);




        //Rotas das Ocorrências
        Route::get('/ocorrencias', [OcorrenciasController::class, 'index'])->name('ocorrencias.index');
        Route::get('/ocorrencias/create', [OcorrenciasController::class, 'create'])->name('ocorrencias.create');
        Route::post('/ocorrencias/create', [OcorrenciasController::class, 'store'])->name('ocorrencias.store');
        Route::get('/ocorrencias/{id}/edit', [OcorrenciasController::class, 'edit'])->name('ocorrencias.edit');
        Route::put('/ocorrencias/{id}', [OcorrenciasController::class, 'update'])->name('ocorrencias.update');
        Route::delete('/ocorrencias/{id}', [OcorrenciasController::class, 'destroy'])->name('ocorrencias.destroy');
        Route::get('/graficosOco', [OcorrenciasController::class, 'showMonthlyChartOco'])->name('graficosOco');
        Route::get("/ocorrencias/pdf", "OcorrenciasPDFController@gerarPDF")->name("ocorrencias.pdf");

        //Rotas Enfermaria
        Route::get('/enfermaria', [EnfermariaController::class, 'index'])->name('enfermaria.index');
        Route::get('/enfermaria/create', [EnfermariaController::class, 'create'])->name('enfermaria.create');
        Route::post('/enfermaria/create', [EnfermariaController::class, 'store'])->name('enfermaria.store');
        Route::get('/enfermaria/{id}/edit', [EnfermariaController::class, 'edit'])->name('enfermaria.edit');
        Route::put('/enfermaria/{id}', [EnfermariaController::class, 'update'])->name('enfermaria.update');
        Route::delete('/enfermaria/{id}', [EnfermariaController::class, 'destroy'])->name('enfermaria.destroy');
        Route::get('/graficosEnf', [EnfermariaController::class, 'showMonthlyChart'])->name('graficosEnf');



        //Rota para manter o card dos alunos
        Route::post('/alunos', 'AlunosController@store')->name('alunos.store');







        //Graficos  
        Route::get('/graficos', function () {
            return view('layouts.partials.graficos');
        })->name('graficos');

        //AlunoPassados  
        Route::get('/alunosPassados', [AlunosController::class, 'mostrarAlunosPassados'], function () {
            return view('layouts.partials.alunosPassados');
        })->name('alunosPassados');

        //Password reset routes

        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


        //Rota Passar Alunos 
        Route::get('/passar_ano', function () {
            return view('layouts.partials.passar_ano');
        })->name('passar_ano');

        Route::post('/alunos/passar-de-ano', [AlunosController::class, 'passarDeAno'])->name('alunos.passarDeAno');

        Route::get('/passar-ano', [AlunosController::class, 'promoverAlunos'])->name('passar_ano');

        // No arquivo routes/web.php
        // No arquivo routes/web.php
        








        /**
         * Logout Routes
         */
        Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    });
});
