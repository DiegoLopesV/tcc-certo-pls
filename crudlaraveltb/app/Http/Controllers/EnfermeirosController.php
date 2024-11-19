<?php

namespace App\Http\Controllers;
use App\Models\Enfermeiros;
use Illuminate\Http\Request;

class EnfermeirosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
                // Busca todos os professores e passa para a view
                $enfermeiros = Enfermeiros::all();
    
                return view('professores.index', ['enfermeiros' => $enfermeiros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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


        return redirect()->route('professores.index')->withSuccess(__('Enfermeiro criado com sucesso.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
