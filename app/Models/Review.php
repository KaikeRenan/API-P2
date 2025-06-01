<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use App\Models\Livro;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = ['nota','texto','usuario_id','livro_id'];

    public function usuarios() {
        return $this->belongsTo(Usuario::class, 'usuario_id','id');
    }

    public function livros() {
        return $this->belongsTo(Livro::class, 'livro_id','id');
    }
}
