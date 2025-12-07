<?php

namespace App\Http\Middleware;

use Illuminate\Session\Middleware\AuthenticateSession;

class AuthenticateAdminSession extends AuthenticateSession
{
    protected function guard()
    {
        return auth()->guard('admin');
    }
}
