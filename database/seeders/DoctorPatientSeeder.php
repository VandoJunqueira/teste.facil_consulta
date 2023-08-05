<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorPatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = Doctor::all();
        $patients = Patient::all();

        // Cria as associações entre médicos e pacientes
        foreach ($doctors as $doctor) {
            $patientsIds = $patients->random(10)->pluck('id')->toArray();
            $doctor->patients()->sync($patientsIds);
        }
    }
}
