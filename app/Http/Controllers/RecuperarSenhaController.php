<?php

namespace App\Http\Controllers;

use App\Mail\CodigoRecuperacaoMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RecuperarSenhaController extends Controller
{
    // Conforme o requisito: usar e-mail institucional.
    private const DOMINIOS_PERMITIDOS = ['aluno.iffar.edu.br', 'iffar.edu.br'];

    private const TEMPO_EXPIRACAO_MINUTOS = 3;

    private function dominioValido(string $email): bool
    {
        $partes = explode('@', $email);

        if (count($partes) !== 2) {
            return false;
        }

        return in_array(strtolower($partes[1]), self::DOMINIOS_PERMITIDOS, true);
    }

    // Tela 1: informar e-mail.
    public function create()
    {
        return view('recuperar_senha');
    }

    // Envia o código de 6 dígitos por e-mail.
    public function enviarCodigo(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Informe seu e-mail institucional.',
            'email.email' => 'Informe um e-mail válido.',
        ]);

        if (!$this->dominioValido($request->email)) {
            return back()
                ->withErrors(['email' => 'Use seu e-mail institucional (@aluno.iffar.edu.br ou @iffar.edu.br).'])
                ->onlyInput('email');
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()
                ->withErrors(['email' => 'E-mail não cadastrado.'])
                ->onlyInput('email');
        }

        $codigo = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        DB::table('codigos_recuperacao')
            ->where('email', $request->email)
            ->delete();

        DB::table('codigos_recuperacao')->insert([
            'email' => $request->email,
            'codigo' => $codigo,
            'expira_em' => Carbon::now()->addMinutes(self::TEMPO_EXPIRACAO_MINUTOS),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Mail::to($request->email)->send(new CodigoRecuperacaoMail($codigo));

        $request->session()->put('recuperacao_email', $request->email);
        $request->session()->forget('recuperacao_codigo_validado');

        return redirect()
            ->route('codigo.form')
            ->with('status', 'Código enviado para o seu e-mail institucional.');
    }

    // Tela 2: informar código.
    public function codigoForm(Request $request)
    {
        $email = $request->session()->get('recuperacao_email');

        if (!$email) {
            return redirect()->route('password.request');
        }

        return view('codigo_verificacao', ['email' => $email]);
    }

    // Verifica o código digitado.
    public function verificarCodigo(Request $request)
    {
        $request->validate([
            'codigo' => ['required', 'string', 'size:6'],
        ], [
            'codigo.required' => 'Informe o código recebido por e-mail.',
            'codigo.size' => 'O código precisa ter 6 dígitos.',
        ]);

        $email = $request->session()->get('recuperacao_email');

        if (!$email) {
            return redirect()->route('password.request');
        }

        $registro = DB::table('codigos_recuperacao')
            ->where('email', $email)
            ->where('codigo', $request->codigo)
            ->first();

        if (!$registro) {
            return back()->withErrors(['codigo' => 'Código inválido.']);
        }

        if (Carbon::parse($registro->expira_em)->isPast()) {
            return back()->withErrors(['codigo' => 'Código expirado. Reenvie o código.']);
        }

        $request->session()->put('recuperacao_codigo_validado', $request->codigo);

        return redirect()->route('nova.senha.form');
    }

    // Tela 3: informar nova senha.
    public function novaSenhaForm(Request $request)
    {
        $email = $request->session()->get('recuperacao_email');
        $codigo = $request->session()->get('recuperacao_codigo_validado');

        if (!$email || !$codigo) {
            return redirect()->route('password.request');
        }

        return view('nova_senha');
    }

    // Salva a nova senha.
    public function redefinirSenha(Request $request)
    {
        $request->validate([
            'password' => ['required', 'min:8', 'confirmed'],
        ], [
            'password.required' => 'Informe a nova senha.',
            'password.min' => 'A senha precisa ter no mínimo 8 caracteres.',
            'password.confirmed' => 'A confirmação da senha não confere.',
        ]);

        $email = $request->session()->get('recuperacao_email');
        $codigo = $request->session()->get('recuperacao_codigo_validado');

        if (!$email || !$codigo) {
            return redirect()
                ->route('password.request')
                ->withErrors(['email' => 'Inicie a recuperação de senha novamente.']);
        }

        $registro = DB::table('codigos_recuperacao')
            ->where('email', $email)
            ->where('codigo', $codigo)
            ->first();

        if (!$registro || Carbon::parse($registro->expira_em)->isPast()) {
            return redirect()
                ->route('password.request')
                ->withErrors(['email' => 'Código inválido ou expirado. Inicie o processo novamente.']);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()
                ->route('password.request')
                ->withErrors(['email' => 'Usuário não encontrado.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('codigos_recuperacao')
            ->where('email', $email)
            ->delete();

        $request->session()->forget(['recuperacao_email', 'recuperacao_codigo_validado']);

        return redirect('/')->with('status', 'Senha redefinida com sucesso! Faça login com a nova senha.');
    }
}
