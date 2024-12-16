<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB; 
use App\Models\Professor;
use Illuminate\Http\Request;
use App\Models\Terceirizados;
use App\Models\Enfermeiros;
use App\Models\Lotacao;
use App\Models\Disciplina;

class ProfessoresController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Busca todos os professores, terceirizados e enfermeiros
        $professores = Professor::all();
        $terceirizados = Terceirizados::all();
        $enfermeiros = Enfermeiros::all();
        
        // Busca todas as chaves temporárias
        $chavesTemporarias = DB::table('chaves_temporarias')->select('nome', 'chave')->get();
        
        // Retorna para a view com os dados
        return view('professores.index', [
            'terceirizados' => $terceirizados,
            'professores' => $professores,
            'enfermeiros' => $enfermeiros,
            'chavesTemporarias' => $chavesTemporarias, // Adicionado
        ]);
    }
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('professores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
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


        return redirect()->route('professores.index')->withSuccess(__('Professor criado com sucesso.'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $professor = Professor::find($id);
        if (!$professor) {
            return response()->json(['error' => 'Professor não encontrado'], 404);
        }
        return response()->json($professor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $professor = Professor::find($id);

        if (!$professor) {
            return response()->json(['message' => 'Professor não encontrado'], 404);
        }
    
        // Retorne os dados do professor como JSON
        return response()->json($professor);
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
        // Encontra o professor
        $professor = Professor::find($id);

        if (!$professor) {
            return response()->json(['message' => 'Professor não encontrado'], 404);
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

        // Atualiza os dados do professor
        $professor->update($request->all());

        return response()->json([
            'message' => 'Professor atualizado com sucesso!',
            'professor' => $professor,
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
        $professor = Professor::findOrFail($id);
        $professor->delete();
    
        return response()->json(['message' => 'Professor excluído com sucesso!']);
    }



    public function editTerceirizado($id)
    {
        $terceirizado = Terceirizados::find($id);
        if ($terceirizado) {
            return response()->json($terceirizado);
        } else {
            return response()->json(['error' => 'Terceirizado não encontrado'], 404);
        }
    }

    public function updateTerceirizado(Request $request, $id)
    {
        $terceirizado = Terceirizados::findOrFail($id);
        $terceirizado->update($request->all());
    
        return response()->json([
            'message' => 'Terceirizado atualizado com sucesso!',
            'terceirizado' => $terceirizado,
        ]);
    }

    public function destroyTerceirizado($id)
    {
        $terceirizado = Terceirizados::findOrFail($id);
        $terceirizado->delete();
    
        return response()->json(['message' => 'Terceirizado excluído com sucesso!']);
    }
    public function storeTerceirizado(Request $request)
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


        return redirect()->route('professores.index')->withSuccess(__('Professor criado com sucesso.'));
    }
}