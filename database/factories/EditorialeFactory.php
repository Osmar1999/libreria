<?php

namespace Database\Factories;

use App\Models\Editoriale;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EditorialeFactory extends Factory
{
    protected $model = Editoriale::class;

    public function definition()
    {
        return [
			'nombre_editorial' => $this->faker->name,
			'numero_editorial' => $this->faker->name,
			'direccion_editorial' => $this->faker->name,
        ];
    }
}
