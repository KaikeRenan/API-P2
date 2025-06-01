<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AutorService;
use App\Http\Requests\StoreAutorRequest;
use App\Http\Requests\UpdateAutorRequest;
use App\Http\Resources\AutorResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class AutorController extends Controller
{
    private AutorService $autorService; 


    public function __construct(AutorService $autorService) {
        $this->autorService = $autorService;
    }


    public function get() {
        $autores = $this->autorService->get();
        return AutorResource::collection($autores);
    }


    public function details($id) {
        try {
            $autor = $this->autorService->details($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'autor não encontrado'],404);
        }
        return new AutorResource($autor);
    }


    public function store(StoreAutorRequest $request)
    {
        $data = $request->validated();
        $autor = $this->autorService->store($data);
        return new AutorResource($autor);
    }


    public function update(int $id, UpdateAutorRequest $request) {
        $data = $request->validated();
        try {
            $autor = $this->autorService->update($id, $data);
        } catch(ModelNotFoundException $e) {
            return response()->json(['error'=>'autor não encontrado'],404);
        }
        return new AutorResource($autor);
    }


    public function delete(int $id) {
        try {
            $autor = $this->autorService->delete($id);
        } catch(ModelNotFoundException $e) {
            return response()->json(['error'=>'autor não encontrado'],404);
        }
        return new AutorResource($autor);
    }

        public function listarLivros($id)
    {
        return response()->json($this->autorService->listarLivrosDoAutor($id));
    }

    public function autoresComLivros()
    {
        return response()->json($this->autorService->listarAutoresComSeusLivros());
    }


}
