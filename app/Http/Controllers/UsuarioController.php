<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Services\UsuarioService;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use App\Http\Resources\UsuarioResource;
use App\Http\Resources\ReviewResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UsuarioController extends Controller
{
    private UsuarioService $usuarioService;


    public function __construct(UsuarioService $usuarioService) {
        $this->usuarioService = $usuarioService;
    }


    public function get() {
        $usuarios = $this->usuarioService->get();
        return UsuarioResource::collection($usuarios);
    }


    public function details($id) {
        try {
            $usuario = $this->usuarioService->details($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Usuario não encontrado'],404);
        }
        return new UsuarioResource($usuario);
    }


    public function store(StoreUsuarioRequest $request)
    {
        $data = $request->validated();
        $usuario = $this->usuarioService->store($data);
        return new UsuarioResource($usuario);
    }


    public function update(int $id, UpdateUsuarioRequest $request) {
        $data = $request->validated();
        try {
            $usuario = $this->usuarioService->update($id, $data);
        } catch(ModelNotFoundException $e) {
            return response()->json(['error'=>'Usuario não encontrado'],404);
        }
        return new UsuarioResource($usuario);
    }


    public function delete(int $id) {
        try {
            $usuario = $this->usuarioService->delete($id);
        } catch(ModelNotFoundException $e) {
            return response()->json(['error'=>'Usuario não encontrado'],404);
        }
        return new UsuarioResource($usuario);
    }

    public function reviewsDoUsuario(int $id)
    {
        $reviews = $this->usuarioService->reviewsDoUsuario($id);
        return ReviewResource::collection($reviews);
    }
}
