<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private array $dominiosPermitidos = [
        'iffarroupilha.edu.br',
        'aluno.iffar.edu.br',
    ];

    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->with(['hd' => 'iffarroupilha.edu.br']) // dica de "hosted domain" pro Google (não é 100% garantido)
            ->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors([
                'google' => 'Não foi possível autenticar com o Google.',
            ]);
        }

        $email = $googleUser->getEmail();
        $dominio = substr(strrchr($email, '@'), 1);

        if (!in_array($dominio, $this->dominiosPermitidos)) {
            return redirect()->route('login')->withErrors([
                'google' => 'Use um e-mail institucional (@iffarroupilha.edu.br ou @aluno.iffar.edu.br).',
            ]);
        }

        // Verifica se já existe usuário com esse google_id ou email
        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $email)
            ->first();

        if ($user) {
            if (!$user->google_id) {
                $user->google_id = $googleUser->getId();
                $user->save();
            }
        } else {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $email,
                'google_id' => $googleUser->getId(),
                'password' => Hash::make(Str::random(24)), // senha aleatória, não será usada
                'tipo' => 0, // ajuste conforme sua regra de negócio
                'matricula' => null, // ou peça em uma etapa posterior
                'cpf' => null,       // idem
                'bloqueio' => 0,
            ]);
        }

        Auth::login($user);

        return redirect()->route('inicio');
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Busca usuários ordenados por nome de A-Z com paginação de 10 por página
        $users = User::orderBy('name', 'asc')->paginate(10);

        // Mapeia os dados garantindo o retorno da foto ou da imagem padrão
        $users->getCollection()->transform(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'cpf' => $user->cpf,
                'telefone' => $user->telefone,
                'tipo' => $user->tipo,
                'matricula' => $user->matricula,
                'email' => $user->email,
                'bloqueio' => $user->bloqueio,
                'dt_nasc' => $user->dt_nasc,
                'google_id' => $user->google_id,
                'created_at' => $user->created_at,
                'foto' => $user->foto 
                    ? Storage::url($user->foto) 
                    : asset('assets/foto.jpg'),
            ];
        });

        return view('usuarios', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('usuarios', [
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

    public function aceitarRegulamento(Request $request)
    {
        $user = auth()->user();

        $user->update([
            'aceitou_regulamento' => true,
            'regulamento_aceito_em' => now(),
        ]);

        return redirect()->route('inicio')->with('success', 'Regulamento aceito com sucesso!');
    }

    public function verContatoAdm()
    {
        $adms = User::where('tipo', 1)
            ->orderBy('name', 'asc')
            ->get()
            ->map(function ($adm) {
                return [
                    'id' => $adm->id,
                    'name' => $adm->name,
                    'email' => $adm->email,
                    'telefone' => $adm->telefone,
                    'foto' => $adm->foto 
                        ? Storage::url($adm->foto) 
                        : asset('fotos_usuarios/foto.jpg'),
                ];
            });

        return view('contato-adm', compact('adms'));
    }
}