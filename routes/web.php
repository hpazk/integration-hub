<?php

use App\Filament\Pages\ServiceData;
use App\Filament\Pages\ServiceFormPage;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/services', ServiceFormPage::class)->name('services.index');
Route::post('/services', [ServiceFormPage::class, 'submit'])->name('services.submit');
Route::get('/service-data', action: [ServiceData::class])->name('service-data');
