<?php

use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Routes Publik untuk Pelaporan Anonim
Route::get('/lapor', [ReportController::class, 'create'])->name('lapor.create');
Route::post('/lapor', [ReportController::class, 'store'])->name('lapor.store');
Route::get('/lapor/sukses', [ReportController::class, 'sukses'])->name('lapor.sukses');
Route::get('/track', [ReportController::class, 'showTrackForm'])->name('track.form');
Route::post('/track', [ReportController::class, 'track'])->name('track');

// Admin Authentication
Route::get('/admin/login', [App\Http\Controllers\AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [App\Http\Controllers\AdminAuthController::class, 'logout'])->name('admin.logout');

// Routes Admin (dengan middleware auth)
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminReportController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/customer-service', [ChatController::class, 'index'])->name('admin.chat.index');
    Route::get('/admin/chat/sessions', [ChatController::class, 'sessions'])->name('admin.chat.sessions');
    Route::get('/admin/chat/messages', [ChatController::class, 'getMessages'])->name('admin.chat.messages');
    Route::post('/admin/chat/reply', [ChatController::class, 'adminReply'])->name('admin.chat.reply');
    Route::delete('/admin/chat/messages/{id}', [ChatController::class, 'deleteMessage'])->name('admin.chat.deleteMessage');
    Route::delete('/admin/chat/sessions/{session_id}', [ChatController::class, 'deleteSession'])->name('admin.chat.deleteSession');
    Route::patch('/admin/reports/{id}/status', [AdminReportController::class, 'updateStatus'])->name('admin.reports.updateStatus');
    Route::put('/admin/reports/{id}/notes', [AdminReportController::class, 'saveNote'])->name('admin.reports.saveNote');
    Route::delete('/admin/reports/{id}/notes', [AdminReportController::class, 'deleteNote'])->name('admin.reports.deleteNote');
    Route::delete('/admin/reports/{id}', [AdminReportController::class, 'destroy'])->name('admin.reports.destroy');
    Route::get('/admin/reports/{id}/detail', [AdminReportController::class, 'detail'])->name('admin.reports.detail');
});

Route::get('/chat/messages', [ChatController::class, 'getMessages'])->name('chat.getMessages');
Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');

// Routes Super Admin (hanya untuk super_admin)
Route::middleware('auth')->group(function () {
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index')->middleware('role:super_admin');
    Route::post('/admin/users', [AdminUserController::class, 'store'])->name('admin.users.store')->middleware('role:super_admin');
    Route::put('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update')->middleware('role:super_admin');
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy')->middleware('role:super_admin');
});
