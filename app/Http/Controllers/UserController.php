<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cadastro');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'tipo'     => 'required|boolean',
            'matricula' => 'required|string|max:255',
            'password' => 'required',
            'cpf' => 'required|string|max:255',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['bloqueio'] = 0;
        User::create($data);

        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('perfil', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'cpf' => $user->cpf,
                'dt_nasc' => $user->dt_nasc,
                'email' => $user->email,
                'matricula' => $user->matricula,
                'telefone' => $user->telefone,
                'foto' => $user->foto 
                    ? Storage::url($user->foto) 
                    : '/fotos_usuarios/foto.jpg',
            ],
            'is_own_profile' => auth()->id() === $user->id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (auth()->id() != $id) {
            abort(403, 'Acesso negado');
        }

        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string',
            'cpf' => 'nullable|string',
            'dt_nasc' => 'nullable|date',
            'matricula' => 'nullable|string',
            'telefone' => 'nullable|string',
            'foto' => 'nullable|image|max:2048',
        ]);

        $data = array_filter($data, function ($value) {
            return !is_null($value);
        });

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('fotos_usuarios', 'public');

            if ($user->foto) {
                Storage::disk('public')->delete($user->foto);
            }

            $data['foto'] = $path;
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id);
    }

    public function toggleBlock(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        if($user->tipo==0) {
            if ($user->bloqueio == 0) $user->bloqueio = 1;
            else $user->bloqueio = 0;
            $user->save();
        }
        return back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id) 
    {
        $user = User::findOrFail($id);
        $authUser = auth()->user();

        if ($authUser->id === $user->id || $authUser->tipo === 1) {
            if ($authUser->id === $user->id) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                $user->delete();
                return redirect('/');
            }
            $user->delete();
            return back();
        }
        abort(403);
    }
}
