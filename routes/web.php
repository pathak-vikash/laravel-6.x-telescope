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


// commands
Route::get("/commands", function(){
    \Artisan::call('inspire');

    return "Command run!";
});


// schedulers
Route::get("/schedulers", function(){
    \Artisan::call("schedule:run");

    return "Scheduler finished!";
});

// Jobs + Logs.
Route::get("/jobs/{count}", function($count){

    $user = getUser();

    for ($i = 0; $i < $count; $i++){
        \App\Jobs\Logger::dispatch($user);
    }

    return "Jobs dispatched!";
});

// Exception
Route::get("/exceptions", function(){
    throw new Exception("Exception: Some people are using mobile right now!");
});

Route::get("/logs", function(){
    \Log::info("Demo logs");
});

// dumps
Route::get("/dumps", function(\Request $request){

    $user = getUser();
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

    $user = getUser();
    event(new \App\Events\NewUserRegistration($user));

    return "Event fired!";
    // event will be fired here
});


// notifications
Route::get("/notifications", function (){

    $user = getUser();

    $user->notify(new \App\Notifications\WelcomeUser());
    //dd($user);
    return "Notification sent!";
});


// cache
Route::get("/cache", function(){
    
    // cached for 60 seconds
    $value = \Cache::remember('user', 60, function(){
        return getUser();
    });

    return "Data cached!";
});


// redis
Route::get('/redis', function(){
    \Redis::enableEvents();

    \Redis::set("name", "Vikash Pathak");

    return \Redis::get("name");
});


function getUser(){
    return Auth::check() ? \Auth::user() : \App\User::find(1);
}

