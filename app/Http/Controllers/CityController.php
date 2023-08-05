<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Repositories\CityRepository;

class CityController extends Controller
{

    private $cityRepository;

    /**
     * Injeta o repositório de Cidade no controller.
     */
    function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * Retorna todas as cidades em formato JSON.
     */
    public function index()
    {
        try {
            $cities = $this->cityRepository->all();

            return response()->json($cities);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Ocorreu um erro.'], 505);
        }
    }

    /**
     * Retorna todos os médicos associados a uma cidade específica em formato JSON.
     *
     * @param int $city_id O ID da cidade cujos médicos desejamos obter.
     * @return \Illuminate\Http\JsonResponse
     */
    public function doctors($city_id)
    {
        try {
            if (!$city = $this->cityRepository->find($city_id)) {
                return response()->json(['message' => 'Cidade não encontrada'], 404);
            }

            return response()->json($city->doctors);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Ocorreu um erro.'], 505);
        }
    }
}
