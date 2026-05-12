<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        if (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('admin')) {

            return redirect()->route('dashboard');
        }

        return redirect()->route('users.dashboard');
    }
}