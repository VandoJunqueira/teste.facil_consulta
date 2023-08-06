<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        try {
            $requestData = $request->all();
            $validator = Validator::make($requestData, [
                'email' => 'email|required',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 422);
            }

            if (!$token = auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
                return response()->json(['error' => 'UnAuthorised Access'], 401);
            }

            return $this->respondWithToken($token);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Ocorreu um erro.'], 505);
        }
    }

    /**
     * Obtém o Usuário autenticado.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        try {
            return response()->json(auth()->user());
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Ocorreu um erro.'], 505);
        }
    }

    /**
     * Realiza o logout do usuário (invalida o token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            auth()->logout();

            return response()->json(['message' => 'Logout realizado com sucesso']);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Ocorreu um erro.'], 505);
        }
    }

    /**
     * Atualiza um token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        try {
            return $this->respondWithToken(auth()->refresh());
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Ocorreu um erro.'], 505);
        }
    }

    /**
     * Retorna a estrutura de array do token.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL()
        ]);
    }
}
