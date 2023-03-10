<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TravelController;
use App\Http\Controllers\StepController;
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

Route::redirect('/', '/travels');

/*
    Travels
*/
Route::get('travels', [TravelController::class, 'index']);
Route::get('travels/add', [TravelController::class, 'addForm']);
Route::post('travels/add', [TravelController::class, 'add']);

/*
    Steps
*/
Route::get('steps/delete/{step:id}', [StepController::class, 'delete'])->where('step', '[0-9]+');