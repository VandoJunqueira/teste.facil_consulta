<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorRequest;
use App\Models\Patient;
use App\Repositories\DoctorRepository;
use Illuminate\Http\Request;

class DoctorController extends Controller
{

    private $doctorRepository;

    /**
     * Injeta o repositório de Médico no controller.
     */
    function __construct(DoctorRepository $doctorRepository)
    {
        $this->doctorRepository = $doctorRepository;
    }

    /**
     * Retorna todos os médicos em formato JSON.
     */
    public function index()
    {
        try {
            $doctors = $this->doctorRepository->all();

            return response()->json($doctors);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Ocorreu um erro.'], 505);
        }
    }

    /**
     * Armazena um novo médico a partir dos dados da requisição.
     *
     * @param DoctorRequest $request Os dados da requisição, incluindo o nome, especialidade e ID da cidade do médico.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DoctorRequest $request)
    {
        try {
            $doctor = $this->doctorRepository->store([
                'name' => $request->nome,
                'specialty' => $request->especialidade,
                'city_id' => $request->cidade_id,
            ]);

            return response()->json($doctor);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Ocorreu um erro.'], 505);
        }
    }

    /**
     * Retorna todos os pacientes associados a um médico específico em formato JSON.
     *
     * @param int $doctor_id O ID do médico cujos pacientes desejamos obter.
     * @return \Illuminate\Http\JsonResponse
     */
    public function patients($doctor_id)
    {
        try {
            if (!$doctor = $this->doctorRepository->find($doctor_id)) {
                return response()->json(['message' => 'Médico não encontrado'], 404);
            }

            return response()->json($doctor->patients);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Ocorreu um erro.'], 505);
        }
    }

    /**
     * Vincula um novo paciente ao médico.
     *
     * @param int $doctor_id O ID do médico ao qual o paciente será vinculado.
     * @param Request $request Os dados da requisição, incluindo o ID do paciente a ser vinculado.
     * @return \Illuminate\Http\JsonResponse
     */
    public function storePatient($doctor_id, Request $request)
    {
        try {
            if (!$doctor = $this->doctorRepository->find($doctor_id)) {
                return response()->json(['message' => 'Médico não encontrado'], 404);
            }

            if (!$patient = Patient::find($request->paciente_id)) {
                return response()->json(['message' => 'Paciente não encontrado'], 404);
            }

            $doctor->patients()->sync($request->paciente_id);

            return response()->json([
                'doctor' => $doctor,
                'patient' => $patient,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Ocorreu um erro.'], 505);
        }
    }
}
