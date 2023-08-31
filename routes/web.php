<?php

use App\Livewire\Car\Create;
use App\Livewire\Car\Index;
use App\Livewire\Car\Edit;

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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', Index::class)->name('cars.index');
    Route::get('/cars/create', Create::class)->name('cars.create');
    Route::get('/cars/{id}', Edit::class)->name('cars.edit');
});
