<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Terceirizados; // Alterado para o modelo de terceirizados
use Illuminate\Http\Request;
use App\Models\Enfermeiros;
use App\Models\Lotacao;
use App\Models\Disciplina;

class TerceirizadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('terceirizados.create'); // Alterado para a view de criação de terceirizados
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Valida os dados recebidos para criação de terceirizado
        $dadosParaSalvar = $request->validate([
            'nome' => 'required|max:255',
            'cpf' => 'required|max:255',
            'telefone' => 'required|max:255',
            'numeroDeContrato' => 'required',
            'data_nascimento' => 'required|date',
            'email' => 'required|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'chave' => 'nullable',
        ]);

        // Criação do novo terceirizado
        Terceirizados::create($dadosParaSalvar);

        return redirect()->route('professores.index')->withSuccess(__('Terceirizado criado com sucesso.'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $terceirizado = Terceirizados::find($id);
        if (!$terceirizado) {
            return response()->json(['error' => 'Terceirizado não encontrado'], 404);
        }
        return response()->json($terceirizado);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $terceirizado = Terceirizados::find($id);

        if (!$terceirizado) {
            return response()->json(['message' => 'Terceirizado não encontrado'], 404);
        }
    
        // Retorne os dados do terceirizado como JSON
        return response()->json($terceirizado);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Encontra o terceirizado
        $terceirizado = Terceirizados::find($id);

        if (!$terceirizado) {
            return response()->json(['message' => 'Terceirizado não encontrado'], 404);
        }

        // Valida os dados recebidos
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14',
            'telefone' => 'required|string|max:20',
            'email' => 'required|email',
            'numeroDeContrato' => 'required|string|max:255',
            'data_nascimento' => 'required|date',
        ]);

        // Atualiza os dados do terceirizado
        $terceirizado->update($request->all());

        return response()->json([
            'message' => 'Terceirizado atualizado com sucesso!',
            'terceirizado' => $terceirizado,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $terceirizado = Terceirizados::findOrFail($id);
        $terceirizado->delete();
    
        return response()->json(['message' => 'Terceirizado excluído com sucesso!']);
    }
}
