<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\PasienController;

Route::get('/', function () {
    return redirect()->route('admin.obat.index');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('index');

    Route::get('obat', [ObatController::class, 'index'])->name('obat.index');            
    Route::get('obat/tambah', [ObatController::class, 'create'])->name('obat.create');   
    Route::post('obat', [ObatController::class, 'store'])->name('obat.store');         
    Route::get('obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit');    
    Route::put('obat/{id}', [ObatController::class, 'update'])->name('obat.update');     
    Route::delete('obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');

    Route::get('pasien', [PasienController::class, 'index'])->name('pasien.index');           
    Route::get('pasien/tambah', [PasienController::class, 'create'])->name('pasien.create');   
    Route::post('pasien', [PasienController::class, 'store'])->name('pasien.store');          
    Route::get('pasien/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit');    
    Route::put('pasien/{id}', [PasienController::class, 'update'])->name('pasien.update');     
    Route::delete('pasien/{id}', [PasienController::class, 'destroy'])->name('pasien.destroy');
});
