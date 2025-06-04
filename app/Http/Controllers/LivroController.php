<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LivroService;
use App\Http\Requests\StoreLivroRequest;
use App\Http\Requests\UpdateLivroRequest;
use App\Http\Resources\LivroResource;
use App\Http\Resources\ReviewResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LivroController extends Controller
{
    private LivroService $livroService;

    public function __construct(LivroService $livroService)
    {
        $this->livroService = $livroService;
    }

    public function get()
    {
        $livros = $this->livroService->get();
        return LivroResource::collection($livros);
    }

    public function details($id)
    {
        try {
            $livro = $this->livroService->details($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Livro não encontrado'], 404);
        }
        return new LivroResource($livro);
    }

    public function store(StoreLivroRequest $request)
    {
        $data = $request->validated();
        $livro = $this->livroService->store($data);
        return new LivroResource($livro);
    }

    public function update(int $id, UpdateLivroRequest $request)
    {
        $data = $request->validated();
        try {
            $livro = $this->livroService->update($id, $data);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Livro não encontrado'], 404);
        }
        return new LivroResource($livro);
    }

    public function delete(int $id)
    {
        try {
            $livro = $this->livroService->delete($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Livro não encontrado'], 404);
        }
        return new LivroResource($livro);
    }

    public function listarReviews($id)
    {
        $reviews = $this->livroService->reviewsDoLivro($id);
        return ReviewResource::collection($reviews);
    }

    public function livrosCompletos()
    {
        $livros = $this->livroService->livrosComAutorGeneroReviews();
        return LivroResource::collection($livros);
    }
}
