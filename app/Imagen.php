<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $fillable = [
        'URL'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
