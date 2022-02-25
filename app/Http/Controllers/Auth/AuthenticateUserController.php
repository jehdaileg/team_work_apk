<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthenticateUserController extends Controller
{
    //
    public function create(): \Inertia\Response
    {
        return Inertia::render('Auth/Login');
    }

    public function store(): \Illuminate\Http\RedirectResponse
    {

        $datas = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ], request()->all());

        if(auth()->attempt($datas, remember:true))
        {
            request()->session()->regenerate();

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Credentials do not match !!! Please retry !'
        ]);
    }

    public function logout(): \Illuminate\Http\RedirectResponse
    {


        auth(guard: 'web')->logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->to('/login');
    }

}
