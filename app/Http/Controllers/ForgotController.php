<?php

namespace App\Http\Controllers;

use App\Mail\ForgotMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ForgotRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

// maybe should use another path

class ForgotController extends Controller
{
    public function ForgotPassword(Request $request)
    {
//////////////////////// Rules for Validate request
        $rules =[
            'email' => 'required',
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
//////////////////////// Forgot password

        $email = $request->email;

        if (User::where('email', '=', $email)->doesntExist()) {
            return response([
                'message' => "Email invalid"
            ], 401);
        }

        // generate random token
        $token = rand(10, 100000);

        try {
            DB::table('password_resets')
                ->insert([
                    'email' => $email,
                    'token' => $token
                ]);
            // Send Email
            Mail::to($email)->send(new ForgotMail($token));
            return response([
                'message' => "Reset Password Mail send on your email"
            ], 200);

        } catch (Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }

    }
}
