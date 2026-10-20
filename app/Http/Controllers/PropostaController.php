<?php

namespace App\Http\Controllers;

use App\Models\Proposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PropostaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $propostas = Proposta::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('propostas.index', compact('propostas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('propostas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'dt_entrega' => ['required', 'date'],
            'descricao'  => ['required', 'string'],
            'foto'       => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('fotos_propostas', 'public');
        }

        $data['user_id']     = Auth::id();
        $data['dt_proposta'] = now();
        $data['status']      = 'Em Análise';

        Proposta::create($data);

        return redirect()->route('propostas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proposta = Proposta::findOrFail($id);

        if (Auth::id() !== $proposta->user_id) {
            abort(403);
        }

        if ($proposta->foto) {
            Storage::disk('public')->delete($proposta->foto);
        }

        $proposta->delete();

        return redirect()->route('propostas.index')->with('success', 'Proposta removida com sucesso.');
    }

    public function verStatus(string $id)
    {
        $proposta = Proposta::with('avaliador')->findOrFail($id);

        if (Auth::id() !== $proposta->user_id && Auth::user()->tipo !== 1) {
            abort(403);
        }

        return view('propostas.status', compact('proposta'));
    }

    public function aprovar(Request $request, string $id)
    {
        $data = $request->validate([
            'parecer' => ['nullable', 'string'],
        ]);

        $proposta = Proposta::findOrFail($id);

        $proposta->update([
            'status'        => 'Aprovada',
            'parecer'       => $data['parecer'] ?? null,
            'avaliador_id'  => Auth::id(),
            'dt_avaliacao'  => now(),
        ]);

        return back();
    }

    public function rejeitar(Request $request, string $id)
    {
        $this->autorizarAdmin();

        $data = $request->validate([
            'parecer' => ['required', 'string'],
        ]);

        $proposta = Proposta::findOrFail($id);

        $proposta->update([
            'status'        => 'Rejeitada',
            'parecer'       => $data['parecer'],
            'avaliador_id'  => Auth::id(),
            'dt_avaliacao'  => now(),
        ]);

        return back();
    }
}
