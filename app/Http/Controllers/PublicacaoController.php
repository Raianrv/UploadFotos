<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacao;

class PublicacaoController extends Controller
{
    // Exibir todas as publicações pendentes na tela inicials
    public function index()
    {
        $publicacoes = Publicacao::where('status', 'pendente')->get();
        return view('welcome', compact('publicacoes'));
    }
    

    // Exibir formulário de publicação
    public function create()
    {
        return view('publicar');
    }

    // Armazenar publicação
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'arquivo' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('arquivo')->store('uploads', 's3');

        Publicacao::create([
            'titulo' => $request->titulo,
            'foto_url' => $path,
            'local' => $request->local,
            'data' => $request->data,
            'user_id' => auth()->id(),
            'status' => 'pendente'
        ]);

        return redirect()->route('dashboard')->with('sucesso', 'Foto publicada com sucesso!');
    }

    // Aprovar publicação
    public function approve($id)
    {
        $publicacao = Publicacao::findOrFail($id);
        $publicacao->status = 'aprovado';
        $publicacao->save();

        return redirect()->route('home')->with('sucesso', 'Publicação aprovada!');
    }

    // Rejeitar publicação
    public function reject($id)
    {
        $publicacao = Publicacao::findOrFail($id);
        $publicacao->status = 'rejeitado';
        $publicacao->save();

        return redirect()->route('home')->with('sucesso', 'Publicação rejeitada!');
    }

    // Exibir publicações do usuário logado no dashboard
    public function dashboard()
    {
        $publicacoes = Publicacao::where('user_id', auth()->id())->get();
        return view('dashboard', compact('publicacoes'));
    }
}
