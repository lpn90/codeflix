<?php


namespace CodeFlix\Auth;


use Dingo\Api\Auth\Provider\Authorization;
use Dingo\Api\Routing\Route;
use Illuminate\Http\Request;

class JWTProvider extends Authorization
{

    /**
     * @inheritDoc
     */
    public function getAuthorizationMethod()
    {
        return 'bearer';
    }

    /**
     * @inheritDoc
     */
    public function authenticate(Request $request, Route $route)
    {
        return \Auth::guard('api')->authenticate();
    }
}