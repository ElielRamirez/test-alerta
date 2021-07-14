<?php

use Illuminate\Support\Facades\Route;
use App\Models\Reader;
use App\Models\Meter;
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
    $meters = Meter::join('readers', 'meters.num_meter', '=', 'readers.num_meter')->get();
    return view('index')->with('meters',$meters);
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
