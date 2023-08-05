<?php


namespace App\Repositories;

use App\Models\Patient;

class PatientRepository extends Repository
{
    protected $model;

    public function __construct(Patient $model)
    {
        $this->model = $model;
    }
}
