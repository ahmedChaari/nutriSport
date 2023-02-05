<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) {
        $fields = $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string'
        ]);
        // Check email
        $user = User::where('email', $fields['email'])
             ->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password) ) {
                return response([
                    'message'  => 'Votre mot de passe est incorrect. Veuillez le vérifier.'
                ], 401);
        }
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user'    => new UserResource($user),
            'token'   => $token,
        ];
        return response($response, 200);
    }
//logout after login

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
         return [
              'message'    => 'Logged out',
              'status'     => 200,
          ];
      }
}
