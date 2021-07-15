<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
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
    
    $meters =DB::table('meters')
        ->leftJoin('readers', function ($join) {
            $join->on('readers.num_meter', '=', 'meters.num_meter')
        ->limit(1);
    })->where('meters.instalation_date','!=', null)->get();
  
    return view('index')->with('meters',$meters);
});
Route::get('/meters', function (Request $request) {
    
    return view('meters');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
