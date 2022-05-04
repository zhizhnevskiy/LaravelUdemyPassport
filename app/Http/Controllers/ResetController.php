<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ResetRequest;
use Illuminate\Support\Facades\Validator;

class ResetController extends Controller
{
    public function ResetPassword(Request $request)
    {
//////////////////////// Rules for Validate request
        $rules =[
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed'
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
//////////////////////// Reset Password
        $email = $request->email;
        $token = $request->token;
        $password = Hash::make($request->password);

        $emailCheck = DB::table('password_resets')
            ->where('email', '=', $email)
            ->first();
        if (empty($emailCheck)) {
            return response(['message' => "Email not found"], 401);
        }

        $tokenCheck = DB::table('password_resets')
            ->where('token', '=', $token)
            ->first();
        if (!$tokenCheck) {
            return response(['message' => "Pin code invalid"], 401);
        }

        DB::table('users')
            ->where('email', '=', $email)
            ->update([
                'password' => $password
            ]);

        DB::table('password_resets')
            ->where('email', '=', $email)
            ->delete();

        return response([
            'message' => "Password changed successfully",
        ], 200);
    }
}
