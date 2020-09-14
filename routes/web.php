<?php

use Illuminate\Support\Facades\Route;

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

    $connection = new GearmanClient();
    $connection->addServer('gearman');
    \Illuminate\Support\Facades\Log::error(print_r($connection->getErrno(), true));
    \Illuminate\Support\Facades\Log::error($connection->error());
    /*

    $connection->doBackground('testing', 'test phrase');*/
    // \Illuminate\Support\Facades\Queue::push(new \App\Jobs\TestJob());
});
