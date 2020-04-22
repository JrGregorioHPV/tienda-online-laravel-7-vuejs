<?php

//0 saber si un usuario o producto tiene o no una imagen
    $usuario = App\User::find(1);
    $image->$usuario->image;

    if($image){
        echo 'tiene una imagen';
    } else {
        echo 'no tiene una imagen';
    }

    return $image;

//01 crea una imagen para un usuario utilizanel metodo save

$imagen = new App\Imagen(['URL' => 'imagenes/avatar.png']);

    $usuario = App\User::find(1);
    $usuario->image()->save($imagen);
    return $usuario;




    $imagen = new App\Imagen(['URL' => 'imagenes/avatar.png']);
    $usuario = App\User::find(1);
    $usuario->image()->save($imagen);
    return $usuario;

    $producto = App\Producto::find(1);
    $producto->images()->saveMany([
        new App\Imagen(['URL' => 'imagenes/avatar.png']),
        new App\Imagen(['URL' => 'imagenes/avatar2.png']),
        new App\Imagen(['URL' => 'imagenes/avatar3.png'])
    ]);

    return $producto->images;
