<?php

namespace App\Http\Controllers;

use App\Models\Componente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComponenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Componente::query();

        if ($request->filled('pesquisa')) {
            $query->where('name', 'like', '%' . $request->nome . '%');
        }

        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        $componentes = $query->paginate(12)->withQueryString();

        return view('componente.index', compact('componentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('componente.cadastro');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'descricao' => 'required|string',
            'qt_total' => 'required|integer',
            'qt_disponivel' => 'required|integer',
            'qt_estragada' => 'required|integer',
            'foto1' => 'nullable|image|max:2048',
            'foto2' => 'nullable|image|max:2048',
            'foto3' => 'nullable|image|max:2048',
            'foto4' => 'nullable|image|max:2048',
            'categoria_id' => 'required|integer',
        ]);

        if ($request->hasFile('foto1')) {
            $data['foto1'] = $request->file('foto1')->store('fotos_componentes', 'public');
        }
        if ($request->hasFile('foto2')) {
            $data['foto2'] = $request->file('foto2')->store('fotos_componentes', 'public');
        }
        if ($request->hasFile('foto3')) {
            $data['foto3'] = $request->file('foto3')->store('fotos_componentes', 'public');
        }
        if ($request->hasFile('foto4')) {
            $data['foto4'] = $request->file('foto4')->store('fotos_componentes', 'public');
        }

        Componente::create($data);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $componente = Componente::findOrFail($id);
        return view('componente.show', [
            'componente' => $componente,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $componente = Componente::findOrFail($id);
        return view('componente.edit', compact('componente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $componente = Componente::findOrFail($id);
        $data = $request->validate([
            'name' => 'nullable|string',
            'descricao' => 'nullable|string',
            'qt_total' => 'nullable|integer',
            'qt_disponivel' => 'nullable|integer',
            'qt_estragada' => 'nullable|integer',
            'foto1' => 'nullable|image|max:2048',
            'foto2' => 'nullable|image|max:2048',
            'foto3' => 'nullable|image|max:2048',
            'foto4' => 'nullable|image|max:2048',
        ]);

        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        if ($request->hasFile('foto1')) {
            $path = $request->file('foto1')->store('fotos_componentes', 'public');
            if ($componente->foto1) {
                Storage::disk('public')->delete($componente->foto1);
            }
            $data['foto1'] = $path;
        }

        if ($request->hasFile('foto2')) {
            $path = $request->file('foto2')->store('fotos_componentes', 'public');
            if ($componente->foto2) {
                Storage::disk('public')->delete($componente->foto2);
            }
            $data['foto2'] = $path;
        }

        if ($request->hasFile('foto3')) {
            $path = $request->file('foto3')->store('fotos_componentes', 'public');
            if ($componente->foto3) {
                Storage::disk('public')->delete($componente->foto3);
            }
            $data['foto3'] = $path;
        }

        if ($request->hasFile('foto4')) {
            $path = $request->file('foto4')->store('fotos_componentes', 'public');
            if ($componente->foto4) {
                Storage::disk('public')->delete($componente->foto4);
            }
            $data['foto4'] = $path;
        }

        $componente->update($data);
        return redirect()->route('componente.show', $componente);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Componente $componente)
    {
        $componente->delete();
        return back();
    }

    public function estragados()
    {
        $componentes = Componente::where('qt_estragada', '>', 0)
            ->orderBy('qt_estragada', 'desc')
            ->get();

        return view('componentes.estragados', compact('componentes'));
    }
}
