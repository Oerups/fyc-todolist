<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = explode(
            ':',
            base64_decode(explode(' ', $request->header('Authorization'))[1])
        );
        if (count($credentials) !== 2)
            return response()->json(['error' => 'Unauthenticated'], 401);

        $user = User::where('email', $credentials[0])->first();
        if ($user && password_verify($credentials[1], $user->password)) {
            $token = $user->createToken();
            return response()->json(['token' => $token]);
        } else {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

    }
}
