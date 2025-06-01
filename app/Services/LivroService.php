<?php

namespace App\Services;

use App\Repositories\LivroRepository;

class LivroService
{
    private LivroRepository $livroRepository;

    public function __construct(LivroRepository $livroRepository){
        $this->livroRepository = $livroRepository;
    }

    public function get(){
        $livros = $this->livroRepository->get();
        return $livros;
    }

    public function details($id){
        return $this->livroRepository->details($id);
    }

    public function store(array $data){
        return $this->livroRepository->store($data);
    }

    public function update($id, $data){
        $livro = $this->livroRepository->update($id,$data);
        return $livro;
    }

    public function delete(int $id){
        return $this->livroRepository->delete($id);
    }

    public function reviewsDoLivro($id)
    {
        return $this->livroRepository->reviewsDoLivro($id);
    }

    public function livrosComAutorGeneroReviews()
    {
        return $this->livroRepository->livrosComTudo();
    }
}