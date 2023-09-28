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
        return redirect(route('dashboard'));
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