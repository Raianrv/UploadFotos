<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Publicacao;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PublicacaoController extends Controller
{
    // Exibir todas as publicações pendentes na tela inicial
    public function index()
    {
        // Verificar se a tabela 'publicacoes' existe
        if (Schema::hasTable('publicacoes')) {
            $publicacoes = Publicacao::where('status', 'pendente')->get();
        } else {
            $publicacoes = collect(); // Retorna uma coleção vazia se a tabela não existir
        }

        return view('welcome', compact('publicacoes'));
    }

    // Exibir formulário de publicação
    public function create()
    {
        return view('publicacao.publicar');
    }
    

    public function store(Request $request)
    {
        // Validação do formulário
        $request->validate([
            'titulo' => 'required|string|max:255',
            'arquivo' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'local' => 'nullable|string|max:255',
            'data' => 'nullable|date',
        ]);

        // Criação da nova publicação
        $publicacao = new Publicacao;
        $publicacao->titulo = $request->titulo;
        $publicacao->local = $request->local;
        $publicacao->data = $request->data;

        // Upload da imagem
        if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
            $requestImage = $request->arquivo;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('uploads'), $imageName);
            $publicacao->foto_url = $imageName;
        }

        // Associa a publicação ao usuário logado
        $user = Auth::user();
        $publicacao->user_id = $user->id;
        $publicacao->status = 'pendente';

        // Salva a publicação no banco de dados
        $publicacao->save();

        return redirect()->route('dashboard')->with('sucesso', 'Foto publicada com sucesso!');
    }

    
    

    // Aprovar publicação
    public function approve($id) { 
        $publicacao = Publicacao::findOrFail($id); 
        $publicacao->status = 'aprovado'; 
        $publicacao->save(); 
        
        return redirect()->route('dashboard')->with('sucesso', 'Publicação aprovada!'); 
    }

    // Rejeitar publicação
    public function reject($id) { 
        $publicacao = Publicacao::findOrFail($id); 
        $publicacao->status = 'rejeitado'; 
        $publicacao->save(); 
        
        return redirect()->route('dashboard')->with('sucesso', 'Publicação rejeitada!'); 
    }

    // Exibir publicações do usuário logado no dashboard
    public function dashboard()
    {
        $publicacoes = Publicacao::where('user_id', Auth::id())->get();
        return view('dashboard', compact('publicacoes'));
    }

}

