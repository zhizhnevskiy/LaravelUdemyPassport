<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{
    public function Login(Request $request)
    {
        try {
            if (Auth::attempt($request->only('email', 'password'))) {
                $user = Auth::user();
                $token = $user->createToken('app')->accessToken;

                return response([
                    'message' => "User logged in successfully",
                    'user' => $user,
                    'token' => $token
                ], 200);
            }
        } catch (Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
        return response([
            'message' => "Invalid Email or Password"
        ], 401);
    }

    public function Register(Request $request)
    {
//////////////////////// Rules for Validate request
        $rules =[
            'name' => 'required|max:50',
            'email' => 'required|unique:users|min:5|max:50',
            'password' => 'required|min:5|confirmed'
        ];
//////////////////////// Validate request
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json([
                'result'        => 0,
                'message'       => $validator->errors(),
                'date_time'     => date('Y-m-d H:i'),
            ], 400);
        }
//////////////////////// Register user
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $token = $user->createToken('app')->accessToken;

            return response([
                'message' => "User Registered successfully",
                'user' => $user,
                'token' => $token
            ], 200);

        } catch (Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }
}
