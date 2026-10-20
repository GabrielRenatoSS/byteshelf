<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegulamentoController extends Controller
{
    public function show()
    {
        $tipoUsuario = auth()->user()->tipo;

        if ($tipoUsuario == 0) {
            return view('regulamento_usuario');
        }

        return view('regulamento');
    }
}