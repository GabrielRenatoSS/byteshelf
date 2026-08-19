<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegulamentoController extends Controller
{
    public function show()
    {
        return view('regulamento');
    }

    public function edit()
    {
        return view('admin.regulamento-edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'conteudo' => 'required|string',
        ]);

        file_put_contents(resource_path('views/regulamento-texto.blade.php'), $request->conteudo); //ver o nome que estará no front

        return back();
    }
}