<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', [
            'except' => ['authenticate', 'register']
        ]);
    }

    /**
     * Faz login e retorna usuario com o token
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {

            if (! $token = Auth::attempt($credentials)) {
                return response()->json(['error' => 'Dados inválidos!'], 401);
            }

        } catch (JWTException $e) {
            
            return response()->json(['error' => 'Ocorreu um erro ao criar o token.'], 500);
        }

        $user = Auth::user();

        return response()->json(compact('token', 'user'));
    }

    public function logout()
    {
        try {

            if(Auth::logout()) {
                return response()->json('Usuário deslogado com sucesso!');
            }

        } catch (JWTException $e) {
            
            return response()->json(['error' => 'Ocorreu um erro ao deslogar o usuário.'], 500);
        }
    }

    /**
     * Recuperar usuário pelo token
     */
    public function getAuthenticatedUser()
    {
        try {

            if (! $user = Auth::user()) {
                return response()->json(array('Usuário não encontrado', 404));
            }

        } catch (JWTException $e) {

            return response()->json(array('Token não enviado!', $e->getStatusCode));

        }

        return response()->json(compact('user'));
    }

    /**
     * Cadastrar novo usuário e loga 
     */
    public function register(Request $request, User $user)
    {
        $data = $request->only(['name', 'email', 'password']);
        $data['password'] = bcrypt($data['password']);

        $user->create($data);

        return $this->authenticate($request);
    }

}
