<?php

namespace App\Http\Controllers\Nova;

use Laravel\Nova\Http\Controllers\LoginController as ControllersLoginController;
use Laravel\Nova\Nova;

class LoginController extends ControllersLoginController
{
    public function redirectPath()
    {
        if (!auth()->user()) {
            return '/';
        }
        return auth()->user()->role != null ? Nova::path() : '/home';
    }
}
