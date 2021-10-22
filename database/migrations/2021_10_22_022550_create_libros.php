<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('titulo_libro');
            $table->string('edicion_libro');
            $table->date('fecha_lanzamiento_libro');
            $table->string('idioma_libro');
            $table->text('descripcion_libro');
            $table->integer('paginas_libro');
            $table->string('autor_libro');
            $table->string('categoria_libro');
            $table->string('nombre_documento')->nullable();
           
            $table->unsignedBigInteger('editorial_id')->nullable();

            $table->foreign('editorial_id')
            ->references('id')->on('editoriales')
            ->onDelete('set null')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros');
    }
}
