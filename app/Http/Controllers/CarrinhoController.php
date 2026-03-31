<?php

use Illuminate\Http\Request;

public function index(Request $request)
{
    $carrinho = json_decode($request->cookie('carrinho'), true) ?? [];
    $ids = array_column($carrinho, 'id');
    
    $componentes = Componente::whereIn('id', $ids)->get();
    return view('carrinho.index', compact('carrinho', 'componentes'));
}

public function adicionar(Request $request, $id)
{
    $carrinho = json_decode($request->cookie('carrinho'), true) ?? [];

    if (isset($carrinho[$id])) {
        $carrinho[$id]['quantidade']++;
    } else {
        $carrinho[$id] = [
            'id' => $id,
            'quantidade' => 1
        ];
    }

    cookie()->queue('carrinho', json_encode($carrinho), 60 * 24 * 7);

    return back();
}

public function remover(Request $request, $id)
{
    $carrinho = json_decode($request->cookie('carrinho'), true) ?? [];
    unset($carrinho[$id]);
    cookie()->queue('carrinho', json_encode($carrinho), 60 * 24 * 7);
    return back();
}