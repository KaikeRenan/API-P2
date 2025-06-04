<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GeneroService;
use App\Http\Requests\StoreGeneroRequest;
use App\Http\Requests\UpdateGeneroRequest;
use App\Http\Resources\GeneroResource;
use App\Http\Resources\LivroResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GeneroController extends Controller
{
    private GeneroService $generoService;

    public function __construct(GeneroService $generoService)
    {
        $this->generoService = $generoService;
    }

    public function get()
    {
        $generos = $this->generoService->get();
        return GeneroResource::collection($generos);
    }

    public function details($id)
    {
        try {
            $genero = $this->generoService->details($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Gênero não encontrado'], 404);
        }
        return new GeneroResource($genero);
    }

    public function store(StoreGeneroRequest $request)
    {
        $data = $request->validated();
        $genero = $this->generoService->store($data);
        return new GeneroResource($genero);
    }

    public function update(int $id, UpdateGeneroRequest $request)
    {
        $data = $request->validated();
        try {
            $genero = $this->generoService->update($id, $data);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Gênero não encontrado'], 404);
        }
        return new GeneroResource($genero);
    }

    public function delete(int $id)
    {
        try {
            $genero = $this->generoService->delete($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Gênero não encontrado'], 404);
        }
        return new GeneroResource($genero);
    }

    public function listarLivros($id)
    {
        $livros = $this->generoService->livrosDoGenero($id);
        return LivroResource::collection($livros);
    }

    public function generosComLivros()
    {
        $generos = $this->generoService->generosComSeusLivros();
        return GeneroResource::collection($generos);
    }
}
