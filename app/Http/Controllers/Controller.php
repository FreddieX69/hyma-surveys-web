<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function homeRoute()
    {
        $route = match (auth()->user()->role) {
            1,2,4 => 'dashboard',
            3 => 'initial-data-medic',
        };
        return redirect(route($route));
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }

    public function error404()
    {
        return view('errors.404');
    }
}
