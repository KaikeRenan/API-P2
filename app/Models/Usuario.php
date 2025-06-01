<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = ['nome','email','senha'];

    public function reviews() {
        return $this->hasMany(Review::class, 'usuario_id','id');
    }
}
