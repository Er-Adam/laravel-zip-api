<?php

use App\Http\Controllers\AdderController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'loadMainView']);
Route::get("/county-abc", [CountyController::class, 'abc']);
Route::get('/county-initial', [CountyController::class, 'initial']);


Route::post('delete', [DeleteController::class, 'delete'])->name('delete');

Route::post('download-csv', [DownloadController::class, 'downloadCsv'])->name('download-csv');
Route::post('download-pdf', [DownloadController::class, 'downloadPdf'])->name('download-pdf');
Route::post('send-mail', [MailController::class, 'send'])->name('send-mail');


Route::post('start-edit', [EditController::class, 'start'])->name('start-edit');
Route::post('end-edit', [EditController::class, 'end'])->name('end-edit');
Route::post('stop-edit', [EditController::class, 'stop'])->name('stop-edit');


Route::post('start-add', [AdderController::class, 'start'])->name('start-add');
Route::post('end-add', [AdderController::class, 'end'])->name('end-add');;
Route::post('stop-add', [AdderController::class, 'stop'])->name('stop-add');


Route::get('login', [LoginController::class, 'show']);


require __DIR__ . '/auth.php';
