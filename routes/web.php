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

    return "Dumps completed!";
});

// create-user
Route::get("/create-user", function(){

    $user = new \App\User();

    $user->name = Str::random(10);
    $user->email = Str::random(10).'@gmail.com';
    $user->password = bcrypt('123456');

    $user->save();

    dump($user);
});

// delete-user
Route::get("/delete-user/{user}", function($user){
    $user = \App\User::find($user);
    $res = $user->delete();

    dump($res);
});

// events
Route::get("/events", function(){
    // event will be fired here
});



/** Tasks
 * 
 * Notes: All logs would be auto dump after 12 hours, if you would like to keep after then set options hours. $schedule->command('telescope:prune --hours=48')->daily();
 * switch to night mode.
 * cache with redis - setup with redis
 *  Different log types
 * change slower query notification.
 * 
 *  */

