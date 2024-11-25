<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alunos;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Ocorrencias;
use App\Models\Enfermaria;
use Illuminate\Support\Facades\DB;

class AlunosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // select * from tb_alunos order by id desc limit 10
        $alunos = Alunos::all();
        return view('alunos.index', compact('alunos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("alunos.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function store(Request $request)
     {
 
         // Validações
         $request->validate([
             'nome' => 'required|string|max:255',
             'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validação da foto
         ]);
 
         // Verifica se há uma imagem e faz o upload para a pasta correta
         if ($request->hasFile('foto')) {
             //dd($request->file('foto'));  // Verifique se o arquivo está sendo recebido
             $image = $request->file('foto');
             $imageName = time() . '.' . $image->getClientOriginalExtension();
             $image->move(public_path('assets/img'), $imageName);  // Caminho correto
             $validatedData['foto'] = 'assets/img/' . $imageName;  // Armazena o caminho relativo
         }
 
 
         // Criar novo aluno
         $aluno = new Alunos();
         $aluno->nome = $request->nome;
         $aluno->curso = $request->curso;
         $aluno->turma = $request->turma;
         $aluno->cpf = $request->cpf;
         $aluno->nome_pais = $request->nome_pais;
         $aluno->telefone = $request->telefone;
         $aluno->telefone_pais = $request->telefone_pais;
         $aluno->email = $request->email;
         $aluno->email_pais = $request->email_pais;
         $aluno->data_nascimento = $request->data_nascimento;
         $aluno->napne = $request->napne;
         $aluno->foto = $validatedData['foto'] ?? null;
 
 
 
 
 
         // Mapeia as turmas para o ano_atual
         $anoMap = [
             'Info 1' => 1,
             'Info 2' => 2,
             'Info 3' => 3,
             'Info 4' => 4,
             'Pg 1' => 1,
             'Pg 2' => 2,
             'Pg 3' => 3,
             'Adm 1' => 1,
             'Adm 2' => 2,
             'Adm 3' => 3,
             'Eletrônica 1' => 1,
             'Eletrônica 2' => 2,
             'Eletrônica 3' => 3,
             'Mecânica 1' => 1,
             'Mecânica 2' => 2,
             'Mecânica 3' => 3,
             'Contabilidade 1' => 1,
             'Contabilidade 2' => 2,
             'Contabilidade 3' => 3,
             'Jogos 1' => 1,
             'Jogos 2' => 2,
             'Jogos 3' => 3,
             'Jogos 4' => 4,
             'Pf 1' => 1,
             'Pf 2' => 2,
             'Pf 3' => 3,
         ];
 
         // Define o ano_atual com base na turma
         $anoAtual = $anoMap[$request->turma] ?? 0;
 
         if ($anoAtual === 0) {
             return response()->json(['error' => 'Turma inválida.'], 400);
         }
 
         $aluno->ano_atual = $anoAtual;
         $aluno->status_reprovacao = false;
 
         // Salva o aluno no banco de dados
         $aluno->save();
 
         // Retorna o aluno completo junto com a mensagem de sucesso
         return response()->json([
             'message' => 'Aluno salvo com sucesso!',
             'aluno' => $aluno // Aqui retornamos o aluno completo
         ]);
     }
    

     public function store2(Request $request)
{
    try {
        Log::info('Iniciando o processo de salvamento de aluno.');

        // Validações
        $request->validate(Alunos::$rules);

        // Tratamento de upload de foto, se existir
        $validatedData = [];
        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/img'), $imageName);
            $validatedData['foto'] = 'assets/img/' . $imageName;
        }

        // Mapeamento das turmas para o ano_atual
        $anoMap = [
            'Info 1' => 1, 'Info 2' => 2, 'Info 3' => 3, 'Info 4' => 4,
            'Pg 1' => 1, 'Pg 2' => 2, 'Pg 3' => 3,
            'Adm 1' => 1, 'Adm 2' => 2, 'Adm 3' => 3,
            'Eletrônica 1' => 1, 'Eletrônica 2' => 2, 'Eletrônica 3' => 3,
            'Mecânica 1' => 1, 'Mecânica 2' => 2, 'Mecânica 3' => 3,
            'Contabilidade 1' => 1, 'Contabilidade 2' => 2, 'Contabilidade 3' => 3,
            'Jogos 1' => 1, 'Jogos 2' => 2, 'Jogos 3' => 3, 'Jogos 4' => 4,
            'Pf 1' => 1, 'Pf 2' => 2, 'Pf 3' => 3,
        ];
        
        $anoAtual = $anoMap[$request->turma] ?? 0;
        if ($anoAtual === 0) {
            return response()->json(['error' => 'Turma inválida.'], 400);
        }

        // Criação do usuário
        $user = User::create([
            'nome' => $request->nome,
            'cpf' => preg_replace('/\D/', '', $request->cpf), // Limpa formatação do CPF
            'nome_pais' => $request->nome_pais,
            'telefone' => $request->telefone,
            'telefone_pais' => $request->telefone_pais,
            'email' => $request->email,
            'email_pais' => $request->email_pais,
            'role' => 'ROLE_USER',
            'password' => $request->senha,
            'key' => 'aluno2024',
        ]);
        Log::info('Usuário criado com sucesso.', ['user_id' => $user->id]);

        // Criação do aluno
        $aluno = new Alunos();
        $aluno->nome = $request->nome;
        $aluno->curso = $request->curso;
        $aluno->turma = $request->turma;
        $aluno->cpf = $user->cpf;
        $aluno->nome_pais = $request->nome_pais;
        $aluno->telefone = $request->telefone;
        $aluno->telefone_pais = $request->telefone_pais;
        $aluno->email = $request->email;
        $aluno->email_pais = $request->email_pais;
        $aluno->data_nascimento = $request->data_nascimento;
        $aluno->napne = $request->napne;
        $aluno->foto = $validatedData['foto'] ?? null;
        $aluno->ano_atual = $anoAtual;
        $aluno->status_reprovacao = false;
        $aluno->save();

        Log::info('Aluno criado com sucesso.', ['aluno_id' => $aluno->id]);

        return response()->json([
            'message' => 'Aluno e usuário salvos com sucesso!',
            'aluno' => $aluno,
            'user' => $user
        ]);

    } catch (\Exception $e) {
        Log::error('Erro ao salvar aluno: ' . $e->getMessage());
        return response()->json(['error' => 'Erro ao salvar o aluno.'], 500);
    }
}


     
    
    


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aluno = Alunos::find($id);

        if (!$aluno) {
            return response()->json(['message' => 'Aluno não encontrado'], 404);
        }

        return response()->json($aluno);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alunos = Alunos::findOrFail($id);
        return response()->json($alunos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        // Busca o aluno pelo ID
        $aluno = Alunos::findOrFail($id);
        
        // Validações
        $request->validate([
            'nome' => 'required|string|max:255',
            'curso' => 'required|string|max:255',
            'turma' => 'required|string|max:255',
            'cpf' => 'required|string|max:15',
            'nome_pais' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'telefone_pais' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'email_pais' => 'required|email|max:255',
        ]);


        


        // Verifica se há uma imagem e faz o upload para a pasta correta

        $aluno->nome = $request->nome;
        $aluno->curso = $request->curso;
        $aluno->turma = $request->turma;
        $aluno->cpf = $request->cpf;
        $aluno->nome_pais = $request->nome_pais;
        $aluno->telefone = $request->telefone;
        $aluno->telefone_pais = $request->telefone_pais;
        $aluno->email = $request->email;
        $aluno->email_pais = $request->email_pais;
        $aluno->data_nascimento = $request->data_nascimento;
        $aluno->napne = $request->napne;



        // Salva as atualizações no banco de dados
        $aluno->save();

        // Retorna uma resposta de sucesso
        return response()->json(['message' => 'Aluno atualizado com sucesso!']);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aluno = Alunos::findOrFail($id);
        if ($aluno->foto && Storage::exists($aluno->foto)) {
            Storage::delete($aluno->foto);
        }
        $aluno->delete();

        return response()->json(['message' => 'Aluno excluído com sucesso!']);
    }
    public function showAlunosPorTurma($turma)
    {
        
            // Mapear o formato recebido para o formato correto
    $turmasMap = [
        'info1' => 'Info 1',
        'info2' => 'Info 2',
        'info3' => 'Info 3',
        'info4' => 'Info 4',
        'pg1' => 'Pg 1',
        'pg2' => 'Pg 2',
        'pg3' => 'Pg 3',
        'adm1' => 'Adm 1',
        'adm2' => 'Adm 2',
        'adm3' => 'Adm 3',
        'eletronica1' => 'Eletronica 1',
        'eletronica2' => 'Eletronica 2',
        'eletronica3' => 'Eletronica 3',
        'mecanica1' => 'Mecanica 1',
        'mecanica2' => 'Mecanica 2',
        'mecanica3' => 'Mecanica 3',
        'contabilidade1' => 'Contabilidade 1',
        'contabilidade2' => 'Contabilidade 2',
        'contabilidade3' => 'Contabilidade 3',
        'jogos1' => 'Jogos 1',
        'jogos2' => 'Jogos 2',
        'jogos3' => 'Jogos 3',
        'jogos4' => 'Jogos 4',
        'pf1' => 'Pf 1',
        'pf2' => 'Pf 2',
        'pf3' => 'Pf 3',

        


        // Adicione mais mapeamentos conforme necessário
    ];

    $turmaFormatada = $turmasMap[$turma] ?? $turma; // Usa o valor mapeado ou o valor original se não houver mapeamento

    // Verificar a consulta
    $alunos = Alunos::where('turma', $turmaFormatada)->get();

    
        
        // Remove o prefixo "turma/" e apenas utiliza o nome da turma, formatando o nome corretamente
        $viewName = str_replace(' ', '', strtolower($turma)); // Converte "Info 4" para "info4"
        
        return view('layouts.partials.' . $viewName, compact('alunos'));
    }
    
    
    
    
    
    
    



    public function promoverAlunos(Request $request)
    {
        $alunosParaReprovar = $request->input('alunos_reprovados', []);

        // Recupera todos os alunos
        $alunos = Alunos::all();

        foreach ($alunos as $aluno) {
            if (in_array($aluno->id, $alunosParaReprovar)) {
                // Marca como reprovado
                $aluno->status_reprovacao = true;
            } else {
                // Promove para o próximo ano
                $aluno->ano_atual += 1;
                $aluno->status_reprovacao = false; // Resetar o status de reprovação
            }

            $aluno->save();
        }

        return view('layouts.partials.passar_ano', compact('alunos'));
    }

    public function passarDeAno(Request $request)
    {
        // Definindo turmas de diversos cursos
        $turmas = [
            'Info' => ['Info 1', 'Info 2', 'Info 3', 'Info 4'],
            'Pg' => ['Pg 1', 'Pg 2', 'Pg 3'],
            'Adm' => ['Adm 1', 'Adm 2', 'Adm 3'],
            'Jogos' => ['Jogos 1', 'Jogos 2', 'Jogos 3', 'Jogos 4'],
            'Mecânica' => ['Mecânica 1', 'Mecânica 2', 'Mecânica 3'],
            'Eletrônica' => ['Eletrônica 1', 'Eletrônica 2', 'Eletrônica 3'],
            'Contabilidade' => ['Contabilidade 1', 'Contabilidade 2', 'Contabilidade 3'],
            'Pf' => ['Pf 1', 'Pf 2', 'Pf 3'],
        ];
    
        foreach ($request->input('alunos', []) as $alunoId => $aprovado) {
            if ($aprovado) {
                $aluno = Alunos::find($alunoId);
                $curso = explode(' ', $aluno->turma)[0]; // Extrai o nome do curso
                $cursoFormatado = ucfirst(strtolower($curso)); // Formata o nome do curso para corresponder à chave do array
                $currentTurmaIndex = array_search($aluno->turma, $turmas[$cursoFormatado] ?? []);
    
                // Verifica se o aluno está na última turma
                if ($currentTurmaIndex !== false && $currentTurmaIndex < count($turmas[$cursoFormatado]) - 1) {
                    $aluno->turma = $turmas[$cursoFormatado][$currentTurmaIndex + 1];
                } else {
                    // Caso o aluno esteja na última turma
                    $aluno->turma = 'passou de ano';
                }
    
                $aluno->save();
            }
        }
    
        return response()->json(['message' => 'Alunos atualizados com sucesso!']);
    }
    


    // No seu controlador
    public function mostrarAlunosPassados()
    {
        // Buscar todos os alunos
        $alunos = Alunos::all();

        // Retorne a view com a variável $alunos
        return view('layouts.partials.alunosPassados', compact('alunos'));
    }


    public function deletarAlunos(Request $request)
{
    $alunosIds = $request->input('alunos', []);

    // Verifica se os IDs dos alunos estão presentes
    if (!empty($alunosIds)) {
        Alunos::whereIn('id', $alunosIds)->delete();
    }

    return response()->json(['success' => true]);
}




public function getOcorrenciasAluno($id)
{
    try {
        // Buscar o aluno pelo ID
        $aluno = Alunos::find($id);

        if (!$aluno) {
            return response()->json(['message' => 'Aluno não encontrado'], 404);
        }

        // Buscar todas as ocorrências
        $ocorrencias = Ocorrencias::all();

        // Filtrar as ocorrências que contenham exatamente o nome do aluno no campo de participantes
        $ocorrenciasFiltradas = $ocorrencias->filter(function ($ocorrencia) use ($aluno) {
            // Verificar o tipo de 'participantes' e decodificar se necessário
            $participantes = is_string($ocorrencia->participantes)
                ? json_decode($ocorrencia->participantes, true)
                : $ocorrencia->participantes;
            // Se não for um array válido, trate como vazio
            if (!is_array($participantes)) {
                $participantes = [];
            }
            // Verificar se o aluno está entre os participantes
            foreach ($participantes as $participante) {
                if (
                    isset($participante['nome'], $participante['curso'], $participante['turma']) &&
                    $participante['nome'] === $aluno->nome &&
                    $participante['curso'] === $aluno->curso &&
                    $participante['turma'] === $aluno->turma
                ) {
                    return true;
                }
            }
            return false;
        });

        return response()->json($ocorrenciasFiltradas->values());
    } catch (\Exception $e) {
        return response()->json(['message' => 'Erro ao buscar ocorrências', 'error' => $e->getMessage()], 500);
    }
}


// Enfermaria
public function getEnfermariasAluno($id)
{
    try {
        // Buscar o aluno pelo ID
        $aluno = Alunos::find($id);

        if (!$aluno) {
            return response()->json(['message' => 'Aluno não encontrado'], 404);
        }

        // Buscar todas as ocorrências
        $enfermaria = Enfermaria::all();

        // Filtrar as ocorrências que contenham exatamente o nome do aluno no campo de participantes
        $enfermariasFiltradas = $enfermaria->filter(function ($enfermaria) use ($aluno) {
            // Separar a string de participantes por vírgulas
            $pessoas = explode(',', $enfermaria->pessoas);
            
            // Limpar os espaços em branco extras ao redor dos nomes
            $pessoas = array_map('trim', $pessoas);

            // Verificar se o nome do aluno está na lista de participantes
            return in_array($aluno->nome, $pessoas);
        });

        return response()->json($enfermariasFiltradas->values());
    } catch (\Exception $e) {
        return response()->json(['message' => 'Erro ao buscar ocorrências', 'error' => $e->getMessage()], 500);
    }
}






}


