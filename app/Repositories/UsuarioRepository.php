<?php

namespace App\Repositories;

use App\Models\Usuario;

class UsuarioRepository
{
    public function get(){
        return Usuario::all();
    }

    public function details(int $id){
        return Usuario::findOrFail($id);
    }

    public function store(array $data){
        return Usuario::create($data);
    }

    public function update(int $id, array $data){
        $usuario = $this->details($id);
        $usuario->update($data);
        return $usuario;
    }

    public function delete(int $id){
        $usuario = $this->details($id);
        $usuario->delete();
        return $usuario;
    }

    public function reviewsDoUsuario($usuarioId)
    {
        $reviews = Usuario::with('reviews')->findOrFail($usuarioId)->reviews;
        return $reviews;
    }
}