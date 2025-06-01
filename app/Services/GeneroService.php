<?php

namespace App\Services;

use App\Repositories\GeneroRepository;

class GeneroService
{
    private GeneroRepository $generoRepository;

    public function __construct(GeneroRepository $generoRepository){
        $this->generoRepository = $generoRepository;
    }

    public function get(){
        $generos = $this->generoRepository->get();
        return $generos;
    }

    public function details($id){
        return $this->generoRepository->details($id);
    }

    public function store(array $data){
        return $this->generoRepository->store($data);
    }

    public function update($id, $data){
        $genero = $this->generoRepository->update($id,$data);
        return $genero;
    }

    public function delete(int $id){
        return $this->generoRepository->delete($id);
    }

    public function livrosDoGenero($id)
    {
        return $this->generoRepository->livrosDoGenero($id);
    }

    public function generosComSeusLivros()
    {
        return $this->generoRepository->generosComLivros();
    }
}