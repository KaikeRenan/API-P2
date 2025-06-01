<?php

namespace App\Repositories;

use App\Models\Autor;

class AutorRepository
{
    public function get(){
        return Autor::all();
    }

    public function details(int $id){
        return Autor::findOrFail($id);
    }

    public function store(array $data){
        return Autor::create($data);
    }

    public function update(int $id, array $data){
        $autor = $this->details($id);
        $autor->update($data);
        return $autor;
    }

    public function delete(int $id){
        $autor = $this->details($id);
        $autor->delete();
        return $autor;
    }
    
    public function livrosDoAutor($id)
    {
        $autor = Autor::with('livros')->findOrFail($id);
        return $autor->livros;
    }

    public function autoresComLivros()
    {
        return Autor::with('livros')->get();
    }
}