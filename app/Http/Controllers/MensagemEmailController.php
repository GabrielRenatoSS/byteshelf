<?php

namespace App\Http\Controllers;

use App\Mail\MensagemUsuarioMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MensagemEmailController extends Controller
{
    public function form()
    {
        return view('enviar_mensagem');
    }

    public function enviar(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'assunto' => ['required', 'string', 'max:255'],
            'mensagem' => ['required', 'string'],
        ]);

        Mail::to($request->email)->send(
            new MensagemUsuarioMail($request->assunto, $request->mensagem)
        );

        return back()->with('status', 'Mensagem enviada com sucesso!');
    }
}