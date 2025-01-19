<?php

namespace App\Http\Controllers;
use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnimeController extends Controller
{
    // Método para listar todos os animes

    public function dashboard()
{
    $animes = Anime::all(); // obtem todos os animes do banco de dados
    return view('dashboard', compact('animes')); // passa a variável para a view
}

    public function index()
{
    $animes = Anime::all(); // obtem todos os animes do banco de dados
    return view('dashboard', compact('animes'), ['animes' => $animes]); // certifique-se de que a view é a correta
}

    // metodo para mostrar detalhes de um anime
    public function details($id)
    {
        $anime = Anime::findOrFail($id);
        return view('anime.details', compact('anime'));
    }

    // metodo para exibir formulário de criação (somente admin)
    public function create()
    {
        if (!auth()->user()->is_admin) {
            return redirect()->route('dashboard')->with('error', 'Você não tem permissão para acessar esta página.');
        }
        return view('anime.create');
    }
    
    public function store(Request $request)
{
    // validação dos dados
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    // criação do novo anime
    $anime = new Anime();
    $anime->title = $request->title; // atribui o título
    $anime->description = $request->description; // atribui a descrição
    $anime->save(); // salva o anime no banco de dados

    // redireciona após a criação
    return redirect()->route('animes.index')->with('success', 'Anime criado com sucesso!');
}

    // metodo para editar um anime (somente admin)
    public function edit($id)
    {
        $anime = Anime::findOrFail($id);
        if (Auth::user()->is_admin) {
            return view('anime.edit', compact('anime'));
        } else {
            return redirect()->route('anime.index')->with('error', 'Sem permissão para editar animes.');
        }
    }

    // metodo para atualizar um anime (somente admin)
    public function update(Request $request, $id)
    {
        $anime = Anime::findOrFail($id);
        if (Auth::user()->is_admin) {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            $anime->update($request->all());
            return redirect()->route('anime.index')->with('success', 'Anime atualizado com sucesso!');
        } else {
            return redirect()->route('anime.index')->with('error', 'Sem permissão para atualizar animes.');
        }
    }

    // metodo para deletar um anime (somente admin)
    public function destroy($id)
{
    $anime = Anime::findOrFail($id);
    $anime->delete();

    return redirect()->route('dashboard')->with('success', 'Anime apagado com sucesso!');
}

}
