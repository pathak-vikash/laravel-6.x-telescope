<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Redis.
Route::get("/redis", function(){
    \Redis::set('name', 'Vikash Pathak');

    return \Redis::get("name");
});


// commands
Route::get("/commands", function(){
    \Artisan::call('inspire');
});


// schedulers
Route::get("/schedulers", function(){
    \Artisan::call("schedule:run");
});

// Jobs + Logs.
Route::get("/jobs/{jobs}", function($jobs){

    $user = Auth::check() ? \Auth::user() : \App\User::find(1);

    for ($i = 0; $i < $jobs; $i++){
        \App\Jobs\Logger::dispatch($user);
    }
});

// Exception
Route::get("/exceptions", function(){
    throw new Exception("Exception: Some people are using mobile right now!");
});

// dumps
Route::get("/dumps", function(\Request $request){

    $user = Auth::check() ? \Auth::user() : \App\User::find(1);
    dump($user);
});

// events


