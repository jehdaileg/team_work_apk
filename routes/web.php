<?php


use App\Events\NotifyMember;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function(){
  broadcast(new NotifyMember);
  return Inertia::render('Index');
});


Route::get('/users', function(){
    return Inertia::render('Users/Index');
});


