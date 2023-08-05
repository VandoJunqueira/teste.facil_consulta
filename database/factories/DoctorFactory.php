<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Doctor>
 */
class DoctorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $medicalSpecialties  = [
            'Cardiologista',
            'Dermatologista',
            'Pediatra',
            'Oncologista',
            'Ginecologista',
            'Urologista',
            'Neurologista',
            'Ortopedista',
            'Otorrinolaringologista',
            'Psiquiatra',
            'Endocrinologista',
            'Infectologista',
            'Pneumologista',
            'Oftalmologista',
            'Radiologista',
            'Gastroenterologista',
            'Nefrologista',
            'Cirurgião Plástico',
            'Hematologista',
            'Reumatologista',
        ];

        return [
            'name' => $this->faker->name,
            'specialty' => $this->faker->randomElement($medicalSpecialties),
            'city_id' => rand(1, City::count())
        ];
    }
}
