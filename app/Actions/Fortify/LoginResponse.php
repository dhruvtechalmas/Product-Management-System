<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        if(auth()->user()->hasRole('admin','super-admin'))
        {
            return redirect('/dashboard');
        }

        return redirect('/user-dashboard');
    }
}