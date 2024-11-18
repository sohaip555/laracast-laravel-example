<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Jobs\TranslateJob;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('test', function () {

    $job = Job::first();
    TranslateJob::dispatch($job);
//
//    dispatch(function ()
//    {
//        logger('hello from the queue');
//    });
    return 'Done';
});

//Route::controller(JobController::class)->group(function () {

    Route::get('/jobs', [JobController::class, 'index']);
    Route::get('/jobs/create', [JobController::class, 'create']);
    Route::get( '/jobs/{job}', [JobController::class, 'show']);
    Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->middleware('auth')->can( 'edit','job');
    Route::patch('/jobs/{job}', [JobController::class, 'update'])->middleware('auth')->can( 'update','job');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->middleware('auth')->can( 'delete','job');

//});


Route::view('/', 'home');
Route::view('/contact', 'contact');

//Route::resource('/jobs', JobController::class);


//Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);


Route::get('login', [SessionController::class, 'create'])->name('login');
Route::post('login', [SessionController::class, 'store']);
Route::post('logout', [SessionController::class, 'destroy']);