<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\MailTemplateController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// お問い合わせ
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/contact/thanks', [ContactController::class, 'thanks'])->name('contact.thanks');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // 管理者用お問い合わせ確認
    Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{id}/reply', [AdminContactController::class, 'replyForm'])->name('contacts.reply');
    Route::post('/contacts/{id}/reply', [AdminContactController::class, 'sendReply'])->name('contacts.sendReply');

    // メールテンプレート取得
    Route::get('/templates/{template}/{contact}', [MailTemplateController::class, 'show'])->name('admin.templates.show');
});

require __DIR__.'/auth.php';
