<?php

namespace App\Http\Controllers\Api;

use App\Pedido;
use App\User;
use App\Utils\ApiError;
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
        if(auth()->user()->type == 'administrador') {
            $queryAdmin = Pedido::join('users', 'pedidos.user_id', '=', 'users.id')
                ->join('pecas', 'pedidos.peca_id', '=', 'pecas.id')
                ->select('pecas.description', 'pedidos.adress', 'users.email','users.name', 'pedidos.status')
                ->get();

            try {
                return response()->json($data = [
                'usuario logado' => auth()->user()->type,
                'pedidos' => $queryAdmin], 200);
            }
                catch(\Exception $e) {
                    if(config('app.debut')) {
                        return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
                    }
                return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação', 1010));
            }
        }

        if(auth()->user()->type == 'anunciante') {
            $queryAnunciante = Pedido::join('users', 'pedidos.user_id', '=', 'users.id')
                ->join('pecas', 'pedidos.peca_id', '=', 'pecas.id')
                ->select('pecas.description', 'pedidos.adress', 'users.email','users.name', 'pedidos.status')
                ->where('users.id', '=', auth()->user()->id)
                ->get();

            try {
                return response()->json($data = [
                'usuario logado' => auth()->user()->type,
                'pedidos' => $queryAnunciante]);
            }
                catch(\Exception $e) {
                    if(config('app.debut')) {
                        return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
                    }
                return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação', 1010));
            }
        }

    }

    public function show(int $id) {
        if(auth()->user()->type == 'administrador') {
            $queryAdmin = Pedido::join('users', 'pedidos.user_id', '=', 'users.id')
                ->join('pecas', 'pedidos.peca_id', '=', 'pecas.id')
                ->select('pecas.description', 'pedidos.adress', 'users.email','users.name', 'pedidos.status')
                ->where('pedidos.id', '=', $id)
                ->get();

            try {
                return response()->json($data = [
                'usuario logado' => auth()->user()->type,
                'pedidos' => $queryAdmin], 200);
            }
                catch(\Exception $e) {
                    if(config('app.debut')) {
                        return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
                    }
                return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação', 1010));
            }
        }

        if(auth()->user()->type == 'anunciante') {
            $queryAnunciante = Pedido::join('users', 'pedidos.user_id', '=', 'users.id')
                ->join('pecas', 'pedidos.peca_id', '=', 'pecas.id')
                ->select('pecas.description', 'pedidos.adress', 'users.email','users.name', 'pedidos.status')
                ->where('users.id', '=', auth()->user()->id)
                ->where('pedidos.id', '=', $id)
                ->get();

            try {
                return response()->json($data = [
                'usuario logado' => auth()->user()->type,
                'pedidos' => $queryAnunciante], 200);
            }
                catch(\Exception $e) {
                    if(config('app.debut')) {
                        return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
                    }
                return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação', 1010));
            }
        }
    }

    public function store(Request $request) {

        try {
            $this->pedido->create($data = [
                'user_id' => auth()->user()->id,
                'adress' => $request->adress,
                'status' => $request->status,
                'peca_id' => $request->peca_id
            ]);
            return response()->json(['msg' => 'Pedido criado com sucesso!', 'status' => 201, 'objeto' => $data]);
        }
        catch(\Exception $e) {
            if(config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação', 1010));
        }
    }

    public function update(Request $request, int $id) {

        try {
            if(auth()->user()->type == 'administrador') {
                $user_id = $request->user_id;
            }
            else {
                $user_id = auth()->user()->id;
            }

            $data = $request->all();
            $pedido = $this->pedido->find($id)->where('user_id', '=', auth()->user()->id);
            $pedido->update($data);


            return response()->json(['msg' => 'Pedido atualizado com sucesso!', 'status' => 201, 'objeto' => $data]);
        }
        catch(\Exception $e) {
            if(config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação', 1010));
        }
    }

    public function delete(Pedido $id) {
        try {
            if(auth->user()->type == 'administrador') {
                $id->delete();
                return response()->json(['msg' => 'Pedido excluído com sucesso!', 'status' => 202]);
            }
            else {
                $id->delete()-where('user_id', '=', auth()->user()->id);
                return response()->json(['msg' => 'Pedido excluído com sucesso!', 'status' => 202]);
            }
        }
        catch(\Exception $e) {
            if(config('app.debug')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação', 1010));
        }
    }
}


