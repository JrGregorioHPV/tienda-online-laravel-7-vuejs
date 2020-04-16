<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['Nombre', 'Slug', 'Descripcion'];

    public function Productos()
    {
    	return $this->hasMany(Producto::class);
    }
}
