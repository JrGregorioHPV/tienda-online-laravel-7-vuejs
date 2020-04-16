<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public function Categoria()
    {
    	return $this->belongsTo(Categoria::class, 'Categoria_Id');
    }
}
