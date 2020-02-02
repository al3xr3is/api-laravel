<?php

namespace App\Http\Controllers\Api;

use App\Pedido;
use App\User;
use App\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    private $pedido;
    private $user;

    public function __construct(Pedido $pedido, User $user) {
        $this->pedido = $pedido;
        $this->user = $user;
    }

    public function index() {
        $pedidos = Pedido::join('users', 'pedidos.user_id', '=', 'users.id')
       ->join('pecas', 'pedidos.peca_id', '=', 'pecas.id')
       ->select('pecas.description', 'pedidos.adress', 'users.email','users.name', 'pedidos.status')
       ->get();

            try {
            return response()->json($data = [
                'pedidos' => $pedidos]);
            }
            catch(\Exception $e) {
                if(config('app.debut')) {
                    return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
                }
                return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação', 1010));
            }

    }

    public function show(int $id) {
        $pedidos = Pedido::join('users', 'pedidos.user_id', '=', 'users.id')
       ->join('pecas', 'pedidos.peca_id', '=', 'pecas.id')
       ->select('pecas.description', 'pedidos.adress', 'users.email','users.name', 'pedidos.status')
       ->where('pedidos.id', $id)
       ->get();

        try {
            return response()->json($data = ['data' => $pedidos]);
        }
        catch(\Exception $e) {
            if(config('app.debut')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação', 1010));
        }
    }

    public function store(Request $request) {
        try {
            $this->pedido->create($data = $request->all());
            return response()->json(['msg' => 'Usuário criado com sucesso!', 'status' => 201]);
        }
        catch(\Exception $e) {
            if(config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação', 1010));
        }
    }
}


