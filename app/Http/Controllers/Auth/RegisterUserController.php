<?php

namespace App\Http\Controllers\Auth;

use IntlChar;
use App\Models\Team;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterUserController extends Controller
{
    //

    public function create()
    {

        $teams = Team::all();

        return Inertia::render('Auth/Register', [
            'teams' => $teams
        ]);
    }

    public function store()
    {

        $datas = request()->validate([
            'name' => ['required'],
            'lastname' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['min:5', 'confirmed'],
            'team_id' => 'required'

        ], request()->all());

        $user = User::query()->create($datas);

        Auth::login($user, remember:true);

        return redirect()->to('/');

    }
}
