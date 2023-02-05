<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\registerUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $roleId = 2;

    public function registerClient(registerUserRequest $request,$company_id) {

            $user = User::create([
                'name'       => $request['name'],
                'email'      => $request['email'],
                'address'    => $request['address'],
                'company_id' => $company_id,
                'role_id'    => $this->roleId,
                'password'   => bcrypt($request['password']),
            ]);
             $token = $user->createToken('myapptoken')->plainTextToken;
             $response = [
                $user,
                 'token'     => $token
             ];
             return response($response, 201);
         }


}
