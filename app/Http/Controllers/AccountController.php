<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Usuario;
use Illuminate\Support\Facades\Cookie;


class AccountController extends Controller
{
    public function login()
    {
        return View('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function loginPost(LoginRequest $request): RedirectResponse
    {

        $request->authenticate();
        return redirect('/');

    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): RedirectResponse
    {
        Cookie::forget('usuario');
        Cookie::queue('usuario', '', -1);
        return redirect('/login');
    }
}
