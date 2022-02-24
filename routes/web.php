<?php


use App\Events\NotifyMember;
use App\Models\Todo;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function(){
  return Inertia::render('Index',[
    'todos' => Todo::query()->get()
]);
})->name('home');


Route::get('/users', function(){
    return Inertia::render('Users/Index');
});

/* Just for test  */

Route::post('/todo', function(){
    $data = request()->validate([
        'title' => ['required', 'string']
    ], request()->all());

    $todo_created = Todo::query()->create($data);

   // broadcast(new NotifyMember($todo_created));
    NotifyMember::dispatch($todo_created);

    return redirect()->to('/');
});


