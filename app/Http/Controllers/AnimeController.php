<?php

namespace App\Http\Controllers;
use App\Models\Anime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AnimeController extends Controller
{
    // Método para listar todos os animes

    public function dashboard(Request $request)
{
    // Obter o termo de pesquisa (se houver)
    $search = $request->input('search', ''); // Define a pesquisa com valor vazio por padrão
    
    // Recuperar os animes de forma diferente conforme a pesquisa
    $animesQuery = Anime::query();

    // Se houver pesquisa, mostramos todos os animes que correspondem ao termo
    if ($search) {
        $animesQuery->where('title', 'like', '%' . $search . '%');
    }

    // Se não houver pesquisa, limitamos a 8 animes (apenas na dashboard)
    if (!$search) {
        $animesQuery->limit(8);
    }

    // Ordena os animes pela data de criação (descendente)
    $animesQuery->orderBy('created_at', 'desc');

    // Obtemos os animes com base na consulta construída
    $animes = $animesQuery->get();

    // Limitando a descrição na dashboard
    $animes->transform(function($anime) {
        $anime->description = Str::limit($anime->description, 150, '...'); // Limita a descrição a 150 caracteres
        return $anime;
    });

    // Passamos a variável search e os animes para a view
    return view('dashboard', compact('animes', 'search'));
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
        'img_itens'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    if ($request->hasFile('img_itens')) {

            $filenameWithExt = $request->file('img_itens')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('img_itens')->getClientOriginalExtension();

            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            $pathd = $request->file('img_itens')->storeAs('public/img_itens', $fileNameToStore);

        } else {
            $fileNameToStore = 'noimage.png';
        }
    // criação do novo anime
    $anime = new Anime();
    $anime->title = $request->title; // atribui o título
    $anime->description = $request->description; // atribui a descrição
    $anime->img_itens = $fileNameToStore;
    $anime->save(); // salva o anime no banco de dados
    

    // redireciona após a criação
    return redirect()->route('dashboard')->with('success', 'Anime criado com sucesso!');
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
                'img_itens'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
