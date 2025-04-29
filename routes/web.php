<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\CodeManager;
use App\Livewire\FormDataEdit;
use App\Livewire\FormDataManager;
use App\Livewire\FormManager;
use App\Livewire\TestLivewire;
use App\Livewire\FormDataReport;
use App\Livewire\Users;




// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function () {
    return redirect()->route('forms.index');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/forms', FormManager::class)->name('forms.index');
    Route::get('/form-data/{formId}', FormDataManager::class)->name('form-data.index');
    // Route::get('/form-data/create/{formId}', FormDataManager::class)->name('form-data.create');
    // Route::get('/form-data/{formId}/create/{codeId}', FormDataManager::class)->name('form-data.create');
    Route::get('/form-data/{formId}/create/{codeId?}', FormDataManager::class)->name('form-data.create');
    Route::get('/form-data/create/{formId}/{codeId?}', FormDataManager::class)->name('form-data.create');
    Route::get('/form-data/edit/{id}', FormDataEdit::class)->name('form-data.edit');

    ;
    Route::get('/codes', CodeManager::class)->name('codes.index');
    Route::get('/form-data/{formId}/report', FormDataReport::class)->name('form-data.report');
    Route::get('/users', Users::class)->name('users');

});

// Route::get('/test-livewire', TestLivewire::class);


require __DIR__.'/auth.php';
