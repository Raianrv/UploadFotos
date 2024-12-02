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
    
    public function index()
    {
        if ( $publicacoes = Publicacao::where('status', 'pendente')->get()) {
            
        } else {
            $publicacoes = collect(); 
        }

        return view('welcome', compact('publicacoes'));
    }

    public function create()
    {
        return view('publicacao.publicar');
    }
    

    public function store(Request $request)
    {
       
        $request->validate([
            'titulo' => 'required|string|max:255',
            'arquivo' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'local' => 'nullable|string|max:255',
            'data' => 'nullable|date',
        ]);

        $publicacao = new Publicacao;
        $publicacao->titulo = $request->titulo;
        $publicacao->local = $request->local;
        $publicacao->data = $request->data;

        if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {
            $requestImage = $request->arquivo;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $path = 'uploads/' . $imageName;

            $stream = fopen($requestImage->getPathname(), 'r+');
            Storage::disk('s3')->put($path, $stream, 'public');
            fclose($stream);

            $publicacao->foto_url = Storage::disk('s3')->url($path);
        }

        $user = Auth::user();
        $publicacao->user_id = $user->id;
        $publicacao->status = 'pendente';

        $publicacao->save();

        return redirect()->route('dashboard')->with('sucesso', 'Foto publicada com sucesso!');
    }

    public function destroy($id) {

        $publicacao = Publicacao::find($id);

        if ($publicacao) {
            $publicacao->delete();
            return redirect()->route('dashboard')->with('sucesso', 'Publicação deletada com sucesso');
        } else {
            return redirect()->route('dashboard')->with('erro', 'Publicação não econtrada');
        }
    }
    

    public function approve($id) { 
        $publicacao = Publicacao::findOrFail($id); 
        $publicacao->status = 'aprovado'; 
        $publicacao->save(); 
        
        return redirect()->route('dashboard')->with('sucesso', 'Publicação aprovada!'); 
    }

    public function reject($id) { 
        $publicacao = Publicacao::findOrFail($id); 
        $publicacao->status = 'rejeitado'; 
        $publicacao->save(); 
        
        return redirect()->route('dashboard')->with('sucesso', 'Publicação rejeitada!'); 
    }

    public function dashboard()
    {
        $publicacoes = Publicacao::where('user_id', Auth::id())->get();
        return view('dashboard', compact('publicacoes'));
    }

}

