<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoComponente;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    public function finalizarPedido(Request $request)
    {
        $user = Auth::user();

        if ($user->tipo == 0) {
            $request->validate([
                'dt_retirada'     => ['required', 'date'],
                'dt_solic_entrega' => ['required', 'date'],
                'motivo'          => ['required', 'string'],
            ]);
        }

        $carrinho = json_decode($request->cookie('carrinho'), true) ?? [];

        if (empty($carrinho)) {
            return back()->withErrors(['carrinho' => 'O carrinho está vazio.']);
        }

        $pedidosAtivos = Pedido::where('id_usuario', $user->id)->where('ativo', 1)->count();

        if ($pedidosAtivos >= 3) {
            return back()->withErrors(['limite' => 'Você já possui 3 pedidos ativos. Aguarde antes de fazer um novo pedido.']);
        }

        $dadosPedido = [
            'dt_solicitacao' => now()->toDateString(),
            'renov'          => 0,
            'ativo'          => 1,
            'tipo'           => $user->tipo,
            'id_usuario'     => $user->id,
        ];

        if ($user->tipo == 0) {
            $dadosPedido['dt_retirada']     = $request->dt_retirada;
            $dadosPedido['dt_solic_entrega'] = $request->dt_solic_entrega;
            $dadosPedido['motivo']          = $request->motivo;
            $dadosPedido['status']          = 'Em Análise';
        } else {
            $dadosPedido['status'] = 'Pronto para Retirada';
        }

        $pedido = Pedido::create($dadosPedido);

        foreach ($carrinho as $item) {
            PedidoComponente::create([
                'pedido_id'     => $pedido->id,
                'componente_id' => $item['id'],
                'quantidade'    => $item['quantidade'],
            ]);
        }

        cookie()->queue(cookie()->forget('carrinho'));

        return redirect()->route('catalogo')->with('success', 'Pedido realizado com sucesso!');
    }

    public function verStatus(Request $request, $id)
    {
        $pedido = Pedido::with(['componentes' => function ($query) {
            $query->select('componentes.id', 'componentes.name', 'componentes.foto1');
        }])->findOrFail($id);

        $pedido->componentes->transform(function ($componente) {
            $componente->foto = $componente->foto1 ?? 'componentes/foto_padrao.png';
            return $componente;
        });

        return view('pedidos.status', compact('pedido'));
    }

    public function index()
    {
        $pedidos = Pedido::with(['componentes' => function ($query) {
            $query->select('componentes.id', 'componentes.name', 'componentes.foto1');
        }, 'usuario'])
        ->where('ativo', 1)
        ->where('tipo', 0)
        ->get();

        $pedidos->each(function ($pedido) {
            $pedido->componentes->transform(function ($componente) {
                $componente->foto = $componente->foto1
                    ? asset(Storage::url($componente->foto1))
                    : asset('imagens/componente_padrao.png');
                return $componente;
            });
        });

        return view('pedidos.index', compact('pedidos'));
    }

    public function aprovar($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->update(['status' => 'Em Separação']);

        return back()->with('success', 'Pedido aprovado.');
    }

    public function reprovar(Request $request, $id)
    {
        $request->validate([
            'justificativa' => ['nullable', 'string'],
        ]);

        $pedido = Pedido::findOrFail($id);
        $pedido->update([
            'status'        => 'Negado',
            'justificativa' => $request->justificativa,
            'dt_avaliacao'  => now()->toDateString(),
            'id_avaliador'  => Auth::id(),
        ]);

        return back();
    }

    public function sugerir(Request $request, $id)
    {
        $request->validate([
            'componentes'              => ['required', 'array'],
            'componentes.*.id'         => ['required', 'integer', 'exists:pedido_componentes,componente_id'],
            'componentes.*.quantidade' => ['required', 'integer', 'min:1'],
        ]);

        $pedido = Pedido::findOrFail($id);

        $idsOriginais = PedidoComponente::where('pedido_id', $pedido->id)
            ->pluck('componente_id')
            ->toArray();

        $idsEnviados = array_column($request->componentes, 'id');

        PedidoComponente::where('pedido_id', $pedido->id)
            ->whereNotIn('componente_id', $idsEnviados)
            ->delete();

        foreach ($request->componentes as $item) {
            PedidoComponente::where('pedido_id', $pedido->id)
                ->where('componente_id', $item['id'])
                ->update(['quantidade' => $item['quantidade']]);
        }

        return back();
    }

    public function aceitarSugestao($id)
    {
        $pedido = Pedido::where('id', $id)
            ->where('id_usuario', Auth::id())
            ->where('status', 'Sugestão em aberto')
            ->firstOrFail();

        $pedido->update(['status' => 'Em Separação']);

        return back();
    }

    public function recusarSugestao($id)
    {
        $pedido = Pedido::where('id', $id)
            ->where('id_usuario', Auth::id())
            ->where('status', 'Sugestão em aberto')
            ->firstOrFail();

        $pedido->update([
            'status' => 'Cancelado',
            'ativo'  => 0,
        ]);

        return back()->with('success', 'Sugestão recusada. Pedido cancelado.');
    }
}