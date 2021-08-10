<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Response;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response()->default(422, 'Validation errors', $validator->errors());
        }

        $user = User::where("email", request('email'))
            ->first();

        if(!empty($user)){
            if (Hash::check(request('password'), $user->password)){
                $data = [
                    'user'  => $user
                ];

                return response()->default(200, 'Login successfully!', $data);
            }
        }

        return response()->default(500, 'Internal Server Error!', []);
    }

     public function test()
    {

        return response()->json(['isSuccess' => true, 'message' => 'Ok'], 200);
    }

    /**
     * pour enregistrer un nouvel utilisateur dans la base de données
     * @param Request $request
     */
    public function create(Request $request)
    {
        try {       
                
            $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'

            ]);

            if($validator->fails()){
                if($validator->fails()){
                    return response()->default(422, 'Validation errors', $validator->errors());
                }
            }

                $user = new User();
                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->password = Hash::make($request->input('password'));
                $user->save();    

                return response()->default(200, 'Account created successfully!', $user);
                
        } catch (Exception $e) {
                $e->getMessage();
        }  

    }

     
}