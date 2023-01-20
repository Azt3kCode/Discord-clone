<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    // Configuration
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Servers
    Route::get('/dashboard', [ServerController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/server/create', [ServerController::class, 'create'])->name('server.create');
    Route::post('/server/store', [ServerController::class, 'store'])->name('server.store');
    Route::get('/server/{id}', [ServerController::class, 'show'])->name('server.show');
    Route::get('/server/{id}/config', [ServerController::class, 'config'])->name('server.config');
    
    // Members
    Route::post('/server/{id}/join', [MemberController::class, 'store'])->name('member.store');

    // Channels
    Route::get('/server/{server}/{channel}', [ChannelController::class, 'show'])->name('channel.show');
    Route::get('/server/{server}/channel/create', [ChannelController::class, 'create'])->name('channel.create');
    Route::post('/server/{server}/channel/store', [ChannelController::class, 'store'])->name('channel.store');
    Route::get('/live-channel', [LiveChannel::class, 'render'])->name('live-channel');

    // Messages
    Route::post('/server/{server}/{channel}/send', [MessageController::class, 'store'])->name('message.store');
});


require __DIR__.'/auth.php';
