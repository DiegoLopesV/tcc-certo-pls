<?php


namespace App\Http\Controllers;
use App\Models\Perfil;
use App\Models\User;
use Illuminate\Http\Request;


class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $user = auth()->user(); // ou o método apropriado para recuperar o usuário logado
    return view('perfil.index', compact('user'));
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
        //
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
{
    $user = User::findOrFail($id);
    return view('perfil.index', compact('user'));
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
    // Validação dos dados
    $validated = $request->validate([
        'nome' => 'required|string|max:255',
        'cpf' => 'required|string|max:14',
        'nome_pais' => 'nullable|string|max:255',
        'telefone' => 'required|string|max:15',
        'telefone_pais' => 'nullable|string|max:15',
        'email' => 'required|email|max:255',
        'email_pais' => 'nullable|email|max:255',
    ]);


    // Encontrar o usuário pelo ID e atualizar os dados
    $user = User::findOrFail($id);
    $user->update($validated);


    // Redirecionar de volta à página com os dados atualizados
    return redirect()->route('perfil.show', ['id' => $user->id])->with('success', 'Dados atualizados com sucesso!');
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



