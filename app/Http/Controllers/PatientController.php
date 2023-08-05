<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientRequest;
use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\PatientUpdateRequest;
use App\Repositories\PatientRepository;

class PatientController extends Controller
{
    private $patientRepository;

    /**
     * Injeta o repositório de Paciente no controller.
     */
    function __construct(PatientRepository $patientRepository)
    {
        $this->patientRepository = $patientRepository;
    }

    /**
     * Armazena um novo paciente a partir dos dados da requisição.
     *
     * @param PatientStoreRequest $request Os dados da requisição, incluindo o nome, CPF e telefone do paciente.
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(PatientStoreRequest $request)
    {
        try {
            $patient = $this->patientRepository->store([
                'name' => $request->nome,
                'cpf' => $request->cpf,
                'phone' => $request->celular,
            ]);

            return response()->json($patient);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Ocorreu um erro.'], 505);
        }
    }

    /**
     * Atualiza os dados de um paciente existente com base nos dados da requisição.
     *
     * @param int $patient_id O ID do paciente cujos dados serão atualizados.
     * @param PatientUpdateRequest $request Os dados da requisição, incluindo o novo nome e telefone do paciente.
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($patient_id, PatientUpdateRequest $request)
    {
        try {
            if (!$patient = $this->patientRepository->find($patient_id)) {
                return response()->json(['message' => 'Paciente não encontrado'], 404);
            }

            $patient->update([
                'name' => $request->nome,
                'phone' => $request->celular,
            ]);

            return response()->json($patient);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Ocorreu um erro.'], 505);
        }
    }
}
