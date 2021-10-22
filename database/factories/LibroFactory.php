<?php

namespace Database\Factories;

use App\Models\Libro;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LibroFactory extends Factory
{
    protected $model = Libro::class;

    public function definition()
    {
        return [
			'titulo_libro' => $this->faker->name,
			'edicion_libro' => $this->faker->name,
			'fecha_lanzamiento_libro' => $this->faker->name,
			'idioma_libro' => $this->faker->name,
			'descripcion_libro' => $this->faker->name,
			'paginas_libro' => $this->faker->name,
			'autor_libro' => $this->faker->name,
			'categoria_libro' => $this->faker->name,
			'editorial_id' => $this->faker->name,
        ];
    }
}
