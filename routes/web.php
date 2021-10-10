<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('index1');
});

Route::resource('employees', EmployeeController::class);
//Route::get('employees/{id}', [EmployeeController::class, 'edit'])
        //->name('employees.edit');

        Route::get("services/{service_id}", [EmployeeController::class, "services"]);
