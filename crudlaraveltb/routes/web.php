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
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\AlunosPDFController;
use App\Http\Controllers\BuscaController;
use App\Models\Enfermaria;
use App\Http\Controllers\ChaveTemporariaController;
use App\Http\Controllers\TerceirizadosController;
use App\Http\Controllers\DesempenhoPDFController;
use App\Http\Controllers\ProfessoresController;

Route::get('send-mail', [MailController::class, 'index']);

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::post('/alunos/store2', [AlunosController::class, 'store2'])->name('alunos.store2');  // Salvar novo aluno

    Route::post('/alunos/check-duplicate', [AlunosController::class, 'checkDuplicate'])->name('alunos.checkDuplicate');


    /**
     * Logout Routes
     */
    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');


    Route::post('/chaves-temporarias/store', [ChaveTemporariaController::class, 'store']);
    Route::get('/chave-temporaria/{nome}', [ChaveTemporariaController::class, 'getChaveByNome']);


    // Registrar Alunoqr
    Route::get('/qrRegistrarAluno', function () {
        return view('layouts.partials.qrRegistrarAluno');
    })->name('qrRegistrarAluno');

    //Rotas Perfil
    Route::get("/perfil", "PerfilController@index")->name("perfil.index");
    //->middleware('can:access');




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

    Route::group(['middleware' => ['auth', 'check_user_key:987xyz']], function () {
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

        Route::put('/professores/{id}', [ProfessoresController::class, 'update'])->name('professores.update');

        Route::get('/professores/{id}', [ProfessoresController::class, 'show']);

        Route::get('/professores/create', 'ProfessoresController@create')->name('professores.create');
        Route::post('/professores/create', 'ProfessoresController@store')->name('professores.store');
        Route::get('/professores/{professor}/show', 'ProfessoresController@show')->name('professores.show');
        Route::get('/professores/{id}/edit', [ProfessoresController::class, 'edit']);

        Route::delete('/professores/{id}', [ProfessoresController::class, 'destroy'])->name('professores.destroy');

        // Para os terceirizados
// Rota para editar o terceirizado (professor) no ProfessoresController
Route::get('/professores/terceirizados/{id}/edit', [ProfessoresController::class, 'editTerceirizado']);
Route::put('/professores/terceirizados/{id}', [ProfessoresController::class, 'updateTerceirizado']);
// Rota para armazenar o novo terceirizado (professor)
Route::post('/professores/terceirizados', [ProfessoresController::class, 'storeTerceirizado'])->name('terceirizados.store');



        
        
        Route::delete('/professores/terceirizados/{id}', [ProfessoresController::class, 'destroyTerceirizado'])->name('terceirizados.destroy');






        //Route::get('/professores', [TerceirizadosController::class, 'index'])->name('professores.index');


        Route::get('/disciplinas', 'DisciplinasController@index')->name('disciplinas.index');
        Route::get('/disciplinas/create', 'DisciplinasController@create')->name('disciplinas.create');
        Route::post('/disciplinas/create', 'DisciplinasController@store')->name('disciplinas.store');
        Route::get('/disciplinas/{disciplina}/show', 'DisciplinasController@show')->name('disciplinas.show');
        Route::get('/disciplinas/{disciplina}/edit', 'DisciplinasController@edit')->name('disciplinas.edit');
        Route::patch('/disciplinas/{disciplina}/update', 'DisciplinasController@update')->name('disciplinas.update');
        Route::delete('/disciplinas/{disciplina}/delete', 'DisciplinasController@destroy')->name('disciplinas.destroy');
        Route::get("/disciplinas/{professor_id}/pdf", "DisciplinaPDFController@gerarPDF")->name("disciplinas.pdf");


        //Filtro Ocorrências
        Route::get('/filtro/{turma}', [OcorrenciasController::class, 'filtro'])->name('ocorrencias.filtro');

        //Rotas das Mensagens
        Route::get("/mensagens", "MensagensController@index")->name("mensagens.index");



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
        Route::get('/alunos', [AlunosController::class, 'index'])->name('alunos.index');  // Exibir todos os alunos
        Route::get('/alunos/create', [AlunosController::class, 'create'])->name('alunos.create');  // Formulário de criação
        Route::post('/alunos', [AlunosController::class, 'store'])->name('alunos.store');  // Salvar novo aluno
        Route::get('/alunos/{id}', [AlunosController::class, 'show'])->name('alunos.show');  // Exibir um aluno específico
        Route::get('/alunos/{id}/edit', [AlunosController::class, 'edit'])->name('alunos.edit');  // Formulário de edição
        Route::put('/alunos/{id}', [AlunosController::class, 'update'])->name('alunos.update');  // Atualizar aluno existente
        Route::delete('/alunos/{id}', [AlunosController::class, 'destroy'])->name('alunos.destroy');  // Excluir aluno
        Route::get('/{turma}', [AlunosController::class, 'showAlunosPorTurma'])
            ->where('turma', 'info[1-4]|pg[1-3]|adm[1-3]|eletronica[1-3]|mecanica[1-3]|contabilidade[1-3]|jogos[1-4]|pf[1-3]')
            ->name('turma');
        Route::post('/deletar-alunos', [AlunosController::class, 'deletarAlunos']);
        Route::get('/alunos/{id}/ocorrencias', [AlunosController::class, 'getOcorrenciasAluno']);
        Route::get('/alunos/{id}/enfermaria', [AlunosController::class, 'getEnfermariasAluno']);
        Route::get('/alunos/pdf/{id}', [AlunosPDFController::class, 'gerarPDF'])->name('alunos.pdf');
        Route::get('/alunos/{id}/gerar-desempenho', [DesempenhoPDFController::class, 'gerarDesempenhoPDF'])->name('gerar.desempenho');


        //Rotas das Ocorrências
        Route::get('/ocorrencias', [OcorrenciasController::class, 'index'])->name('ocorrencias.index');
        Route::get('/ocorrencias/create', [OcorrenciasController::class, 'create'])->name('ocorrencias.create');
        Route::post('/ocorrencias', [OcorrenciasController::class, 'store'])->name('ocorrencias.store');
        Route::get('/ocorrencias/{id}/edit', [OcorrenciasController::class, 'edit'])->name('ocorrencias.edit');
        Route::put('/ocorrencias/{id}', [OcorrenciasController::class, 'update'])->name('ocorrencias.update');
        Route::delete('/ocorrencias/{id}', [OcorrenciasController::class, 'destroy'])->name('ocorrencias.destroy');
        Route::get('/graficosOco', [OcorrenciasController::class, 'showMonthlyChartOco'])->name('graficosOco');
        Route::get("/ocorrencias/pdf", "OcorrenciasPDFController@gerarPDF")->name("ocorrencias.pdf");

        Route::post('/deletar-ocorrencias', [OcorrenciasController::class, 'deletarOcorrencias']);

        Route::get('busca', [BuscaController::class, 'index'])->name('busca.index');

        //Rotas Enfermaria
        Route::get('/enfermaria', [EnfermariaController::class, 'index'])->name('enfermaria.index');
        Route::get('/enfermaria/create', [EnfermariaController::class, 'create'])->name('enfermaria.create');
        Route::post('/enfermaria/create', [EnfermariaController::class, 'store'])->name('enfermaria.store');
        Route::get('/enfermaria/{id}/edit', [EnfermariaController::class, 'edit'])->name('enfermaria.edit');
        Route::put('/enfermaria/{id}', [EnfermariaController::class, 'update'])->name('enfermaria.update');
        Route::delete('/enfermaria/{id}', [EnfermariaController::class, 'destroy'])->name('enfermaria.destroy');
        Route::get('/graficosEnf', [EnfermariaController::class, 'showMonthlyChart'])->name('graficosEnf');
        Route::get("/enfermaria/pdf", "EnfermariaPDFController@gerarPDF")->name("enfermaria.pdf");

        Route::post('/deletar-enfermarias', [EnfermariaController::class, 'deletarEnfermarias']);

        //Rota para manter o card dos alunos
        Route::post('/alunos', 'AlunosController@store')->name('alunos.store');
        Route::get('/perfil/{id}', [PerfilController::class, 'show'])->name('perfil.show');
        Route::put('/perfil/{id}', [PerfilController::class, 'update'])->name('perfil.update');
        

        
        





        //Graficos  
        Route::get('/graficos', function () {
            return view('layouts.partials.graficos');
        })->name('graficos');

        //Materias  
        Route::get('/materias', function () {
            return view('layouts.partials.materias');
        })->name('materias');

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

        Route::post('gerarRelatorioNapne', [AlunosPDFController::class, 'gerarRelatorioNapne'])->name('gerarRelatorioNapne');


        // No arquivo routes/web.php
        // No arquivo routes/web.php




        Route::post('/notifications/read', function () {
            auth()->user()->unreadNotifications->markAsRead();
            return response()->json(['message' => 'Notificações marcadas como lidas']);
        });



        Route::post('/excluirServidores', [ProfessoresController::class, 'excluirServidores']);




    });
});