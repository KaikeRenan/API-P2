<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Autor;
use App\Models\Genero;
use App\Models\Review;

class Livro extends Model
{
    protected $table = 'livros';
    protected $fillable = ['titulo','sinopse','autor_id', 'genero_id'];

    public function autors() {
        return $this->belongsTo(Autor::class, 'autor_id','id');
    }

    public function generos() {
        return $this->belongsTo(Genero::class, 'genero_id','id');
    }

    public function reviews() {
        return $this->hasMany(Review::class, 'livro_id','id');
    }
}
