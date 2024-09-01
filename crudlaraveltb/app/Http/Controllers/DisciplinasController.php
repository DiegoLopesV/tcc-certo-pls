<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disciplina;
use App\Models\Professor;

class DisciplinasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $disciplinas = Disciplina::orderBy("id", "desc")->paginate(10);
        return view('disciplinas.index', compact('disciplinas'));
    }
    
    public function create()
    {
        $professores = Professor::orderBy("id", "DESC")->get();
        return view('disciplinas.create', compact('professores'));
    }
    
    public function store(Request $request)
    {
        $disciplina = new Disciplina();
        
        $disciplina->professor_id = $request['profs'];
        $disciplina->nome = $request["nome"];
        $disciplina->curso = $request["curso"];
        $disciplina->sigla = $request["sigla"];
        $disciplina->carga_horaria = $request["carga_horaria"];
        
        // Insert na table
        $disciplina->save();
        
        return redirect()->route('disciplinas.index')->withSuccess(__('Disciplina criada com sucesso.'));
    }
    
    public function show($id)
    {
        $disciplina = Disciplina::findOrFail($id);
        return view('disciplinas.show', ['disciplina' => $disciplina]);
    }
    
    public function edit($id)
    {
        $disciplina = Disciplina::findOrFail($id);
        return view('disciplinas.edit', ['disciplina' => $disciplina]);
    }
    
    public function update(Request $request, $id)
    {
        $storeData = $request->validate([
            'nome' => 'required|max:255',
            'curso' => 'required|max:255',
            'sigla' => 'required|max:255',
            'carga_horaria' => 'required|numeric',
        ]);
        
        Disciplina::whereId($id)->update($storeData);
        
        return redirect('/disciplinas')->with('completed', 'Disciplina atualizada com sucesso');
    }
    
    public function destroy($id)
    {
        $disciplina = Disciplina::findOrFail($id);
        $disciplina->delete();
        return redirect('/disciplinas')->with('completed', 'Disciplina removida com sucesso');
    }
    
}
