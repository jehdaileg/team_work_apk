<?php


use App\Models\Todo;
use App\Models\User;
use Inertia\Inertia;
use App\Events\NotifyMember;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\AuthenticateUserController;

/*
$user = User::query()->firstOrCreate([
    'email' => 'example@gmail.com',
    'password' => '12345678',
    'name' => 'example',
    'lastname' => 'example',
    'team_id' => 1
]); */

Route::get('/', function(){
 return Inertia::render('Index',[
    'todos' => Todo::query()->get()
]);
//Session::flush();
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

   broadcast(new NotifyMember($todo_created))->toOthers();


    return redirect()->to('/');
});

Route::get('/register', [RegisterUserController::class, 'create'])->name('user.register');
Route::post('/register', [RegisterUserController::class, 'store'])->name('user.store');

Route::get('/login', [AuthenticateUserController::class, 'create'])->name('user.login.form');
Route::post('/login', [AuthenticateUserController::class, 'store'])->name('user.login.store');

Route::post('/logout', [AuthenticateUserController::class, 'logout']);
