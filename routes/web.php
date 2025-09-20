<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\CategoryController;

Route::get('/', function(){ return redirect()->route('archives.index'); });

Route::resource('archives', ArchiveController::class);
Route::get('archives/{archive}/download', [ArchiveController::class, 'download'])->name('archives.download');

Route::resource('categories', CategoryController::class);


// About
Route::view('about','about')->name('about');
