<?php

use App\Events\MessageWelcomeEvent;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function(){
   // return Inertia::render('Index');

   event(new MessageWelcomeEvent("Hello Word"));
});


Route::get('/users', function(){
    return Inertia::render('Users/Index');
});


