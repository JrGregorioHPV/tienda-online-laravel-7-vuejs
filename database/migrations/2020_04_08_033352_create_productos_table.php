<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre')->unique();;
            $table->string('Slug')->unique();;
            $table->unsignedbigInteger('Categoria_Id');
            $table->bigInteger('Cantidad')->unsigned()->default(0);
            $table->decimal('Precio_Anterior', 12, 2)->default(0);
            $table->decimal('Precio_Actual', 12, 2)->default(0);
            $table->integer('Porcentaje_Descuento')->unsigned()->default(0);
            $table->string('Descripcion_Corta')->nullable();
            $table->string('Descripcion_Larga')->nullable();
            $table->string('Especificaciones')->nullable();
            $table->string('Datos_de_Interes')->nullable();
            $table->unsignedbigInteger('Visitas')->default(0);
            $table->unsignedbigInteger('Ventas')->default(0);
            $table->string('Estado');
            $table->char('Activo', 2);
            $table->char('SliderPrincipal', 2);
            $table->timestamps();
            $table->foreign('Categoria_Id')
                  ->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
