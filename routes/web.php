<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FilierController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\GeneratePdf;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\SeanceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('guest')->group(function(){

    Route::get('/login',[LoginController::class,"show"])->name('login.show');
    Route::post('/login',[LoginController::class,"login"])->name('login');
    
});
Route::middleware('auth')->group(function(){

    Route::redirect('/','seances');
    
    Route::resources([
            'filier'=>FilierController::class,
            'formateurs'=>FormateurController::class,
            'groups'=>GroupController::class,
            'salles'=>SalleController::class,
            'seances'=>SeanceController::class,
            'admins'=>AdminController::class
    ]);
    Route::redirect('seances/create','/');
    
    
    Route::get('seances/create/{id}/{periode}/{jour}',[SeanceController::class,'created'])->name('seances.created');
    Route::get('seances/emploiformateur/{id}',[SeanceController::class,'print_formateur_emploi'])->name('seances.print_formateur_emploi');
    Route::get('seances/emploigroupe/{id}',[SeanceController::class,'print_groupe_emploi'])->name('seances.print_groupe_emploi');
    
    Route::post('/salles/delete', [SalleController::class,'deleteMultiple'])->name('salles.deleteMultiple');    
});


Route::get('/logout',[LoginController::class,"logout"])->name('login.logout');
