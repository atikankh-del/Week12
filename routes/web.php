<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/about', [AdminController::class, 'about'])->name('about');

Route::get('/blog', [AdminController::class, 'blog'])->name('blog');

Route::get('/form', [AdminController::class, 'form'])->name('form');

Route::post('/insert', [AdminController::class, 'insert'])->name('insert');

Route::get('/books', [BookController::class, 'index'])->name('book');

Route::post('/books', [BookController::class, 'store'])->name('book.store');

use Illuminate\Support\Facades\DB;

Route::get('test_db', function () {
    try {
        DB::connection('mysql')->getPdo();
        return "เชื่อมต่อฐานข้อมูลสำเร็จ";
    } catch (\Throwable $th) {
        return "Error: " . $th->getMessage();
    }
});

Route::delete('/delete/{id}', [AdminController::class, 'delete'])->name('book.delete');
