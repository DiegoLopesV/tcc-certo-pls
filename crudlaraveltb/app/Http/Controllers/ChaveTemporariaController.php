<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChaveTemporaria;

class ChaveTemporariaController extends Controller
{
    /**
     * Armazena uma nova chave temporária com um nome associado.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:chaves_temporarias,nome',
            'chave' => 'required'
        ]);

        $chaveTemporaria = ChaveTemporaria::create([
            'nome' => $request->nome,
            'chave' => $request->chave,
        ]);

        return response()->json(['message' => 'Chave temporária criada com sucesso!', 'data' => $chaveTemporaria], 201);
    }

    /**
     * Retorna a chave associada ao nome especificado.
     */
    public function getChaveByNome($nome)
    {
        $chaveTemporaria = ChaveTemporaria::where('nome', $nome)->first();

        if ($chaveTemporaria) {
            return response()->json(['chave' => $chaveTemporaria->chave], 200);
        } else {
            return response()->json(['message' => 'Chave não encontrada.'], 404);
        }
    }
}
