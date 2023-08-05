<?php


namespace App\Repositories;

use App\Models\Doctor;

class DoctorRepository extends Repository
{
    protected $model;

    public function __construct(Doctor $model)
    {
        $this->model = $model;
    }
}
