<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/', \App\Livewire\Pages\Dashboard\Home\Index::class)->name('dashboard');
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/users', \App\Livewire\Pages\Dashboard\Users\Index::class)->name('admin.users');
        Route::get('/inventory', \App\Livewire\Pages\Dashboard\Inventory\Index::class)->name('admin.inventory');
        Route::get('/list-peminjaman', \App\Livewire\Pages\Dashboard\Listpeminjaman\Index::class)->name('admin.peminjaman');
        Route::get('/detail/{:id}', \App\Livewire\Pages\Dashboard\Listpeminjaman\Detail::class)->name('admin.detail');
    });
    Route::middleware(['role:user'])->group(function () {
        Route::get('/peminjaman', \App\Livewire\Pages\Dashboard\UserPeminjaman\Index::class)->name('user.peminjaman');
        Route::get('/ajukan-peminjaman', \App\Livewire\Pages\Dashboard\UserPeminjaman\Pengajuan::class)->name('user.pengajuan');
    });
});


require __DIR__.'/auth.php';
