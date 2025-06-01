<?php

namespace App\Services;

use App\Repositories\UsuarioRepository;

class UsuarioService
{
    private UsuarioRepository $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository){
        $this->usuarioRepository = $usuarioRepository;
    }

    public function get(){
        $usuarios = $this->usuarioRepository->get();
        return $usuarios;
    }

    public function details($id){
        return $this->usuarioRepository->details($id);
    }

    public function store(array $data){
        return $this->usuarioRepository->store($data);
    }

    public function update($id, $data){
        $usuario = $this->usuarioRepository->update($id,$data);
        return $usuario;
    }

    public function delete(int $id){
        return $this->usuarioRepository->delete($id);
    }

    public function reviewsDoUsuario($usuarioId)
    {
        return $this->usuarioRepository->reviewsDoUsuario($usuarioId);
    }
}