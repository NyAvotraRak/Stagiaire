<?php

use App\Http\Controllers\AcceuilController;
use App\Http\Controllers\Admin\AccepteController;
use App\Http\Controllers\Admin\AttestationController;
use App\Http\Controllers\Admin\DemandeController;
use App\Http\Controllers\Admin\EtatController;
use App\Http\Controllers\Admin\FonctionController;
use App\Http\Controllers\Admin\MinistereController;
use App\Http\Controllers\Admin\NiveauController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController as ControllersServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-]+';

Route::get('/', [AcceuilController::class, 'index'])->name('acceuil.index');
Route::post('/postule', [AcceuilController::class, 'postule'])->name('acceuil.postule');
Route::get('/services/{slug}-{service}', [AcceuilController::class, 'show'])->name('acceuil.show')->where([
    'service' => $idRegex,
    'slug' => $slugRegex
]);

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::resource('service', ServiceController::class)->except(['show']);
    Route::resource('ministere', MinistereController::class)->except(['show']);
    Route::resource('niveau', NiveauController::class)->except(['show']);
    Route::resource('fonction', FonctionController::class)->except(['show']);
    Route::resource('demande', DemandeController::class)->except(['show', 'edit', 'store', 'create']);
    Route::resource('accepte', AccepteController::class)->except(['show', 'create', 'store']);
    Route::resource('utilisateur', UserController::class)->except(['show', 'create', 'index']);
    Route::post('/accepte/store/{demande}', [AccepteController::class, 'store'])->name('accepte.store');
    Route::get('/accepte/{demande_id}', [AccepteController::class, 'add'])->name('accepte.add');
    Route::get('/attestation/{stagiaire}', [AttestationController::class, 'downloadPdfAttestation'])->name('attestation.downloadPdfAttestation');
    Route::get('/utilisateur', [ProfileController::class, 'index'])->name('utilisateur.index');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
