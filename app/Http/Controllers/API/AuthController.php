<?php

namespace CodeFlix\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use CodeFlix\Http\Controllers\Controller;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function accessToken(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $this->credentials($request);

        if ($token = \Auth::guard('api')->attempt($credentials)){
            return $this->sendLoginResponse($request, $token);
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLoginResponse(Request $request, $token)
    {
        return response()->json(['token' => $token]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json([
            'error' => \Lang::get('auth.failed')
        ], 400);
    }
}
