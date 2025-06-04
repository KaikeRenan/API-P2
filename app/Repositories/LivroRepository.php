<?php

namespace App\Repositories;

use App\Models\Livro;
use App\Models\Review;

class LivroRepository
{
    public function get(){
        return Livro::all();
    }

    public function details(int $id){
        return Livro::findOrFail($id);
    }

    public function store(array $data){
        return Livro::create($data);
    }

    public function update(int $id, array $data){
        $livro = $this->details($id);
        $livro->update($data);
        return $livro;
    }

    public function delete(int $id){
        $livro = $this->details($id);
        $livro->delete();
        return $livro;
    }

    public function reviewsDoLivro($id)
    {
        return Review::with(['usuarios'])->where('livro_id', $id)->get();
    }

    public function livrosComTudo()
    {
        return Livro::with(['autors', 'generos', 'reviews.usuarios'])->get();
    }
}