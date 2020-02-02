<?php

namespace App\Http\Controllers\Api;

use App\Peca;
use App\Utils;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PecaController extends Controller
{
    private $peca;

    public function __construct(Peca $peca) {
        $this->peca = $peca;
    }

    public function index() {
        try {
            return response()->json($data = ['data' => $this->peca->paginate(10)]);
        }
        catch(\Exception $e) {
            if(config('app.debut')) {
                return response()->json(ApiError::errorMessage($e->getMessage(), 1010));
            }
            return response()->json(ApiError::errorMessage('Houve um erro ao realizar a operação', 1010));
        }
    }

    public function show(Peca $id) {
        try {
            return response()->json($data = ['data' => $id]);
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
            $this->peca->create($data = $request->all());
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



