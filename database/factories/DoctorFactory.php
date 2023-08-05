<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
        ];
    }
}
