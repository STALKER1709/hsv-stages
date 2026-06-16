<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\Stagiaire;
use App\Http\Controllers\Encadreur;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/programme', [PublicController::class, 'programme'])->name('programme');
Route::get('/inscription', [InscriptionController::class, 'showForm'])->name('inscription');
Route::post('/inscription', [InscriptionController::class, 'store'])->name('inscription.store');

// Auth
Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Stagiaire
Route::middleware(['auth', 'role:stagiaire'])->prefix('stagiaire')->name('stagiaire.')->group(function () {
    Route::get('/dashboard', [Stagiaire\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/parcours', [Stagiaire\ParcoursController::class, 'index'])->name('parcours');
    Route::get('/cours/{lecon}', [Stagiaire\ParcoursController::class, 'cours'])->name('cours');
    Route::get('/evaluation/{evaluation}', [Stagiaire\EvaluationController::class, 'show'])->name('evaluation');
    Route::post('/evaluation/{evaluation}', [Stagiaire\EvaluationController::class, 'submit'])->name('evaluation.submit');
    Route::get('/profil', [Stagiaire\ProfilController::class, 'show'])->name('profil');
    Route::put('/profil', [Stagiaire\ProfilController::class, 'update'])->name('profil.update');
    Route::put('/profil/password', [Stagiaire\ProfilController::class, 'password'])->name('profil.password');
    Route::get('/attestation', [Stagiaire\AttestationController::class, 'index'])->name('attestation');
    Route::get('/attestation/download', [Stagiaire\AttestationController::class, 'download'])->name('attestation.download');
});

// Encadreur
Route::middleware(['auth', 'role:encadreur'])->prefix('encadreur')->name('encadreur.')->group(function () {
    Route::get('/dashboard', [Encadreur\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stagiaires', [Encadreur\StagiaireController::class, 'index'])->name('stagiaires');
    Route::get('/stagiaires/{stagiaire}', [Encadreur\StagiaireController::class, 'show'])->name('stagiaire.show');
    Route::get('/presences', [Encadreur\PresenceController::class, 'index'])->name('presences');
    Route::post('/presences', [Encadreur\PresenceController::class, 'store'])->name('presences.store');
    Route::get('/cours', [Encadreur\CoursController::class, 'index'])->name('cours');
    Route::get('/cours/create', [Encadreur\CoursController::class, 'create'])->name('cours.create');
    Route::post('/cours', [Encadreur\CoursController::class, 'store'])->name('cours.store');
    Route::get('/cours/{lecon}/edit', [Encadreur\CoursController::class, 'edit'])->name('cours.edit');
    Route::put('/cours/{lecon}', [Encadreur\CoursController::class, 'update'])->name('cours.update');
    Route::delete('/cours/{lecon}', [Encadreur\CoursController::class, 'destroy'])->name('cours.destroy');
});

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stagiaires', [Admin\StagiaireController::class, 'index'])->name('stagiaires');
    Route::get('/stagiaires/{stagiaire}', [Admin\StagiaireController::class, 'show'])->name('stagiaire.show');
    Route::post('/stagiaires/{stagiaire}/valider', [Admin\StagiaireController::class, 'valider'])->name('stagiaire.valider');
    Route::post('/stagiaires/{stagiaire}/rejeter', [Admin\StagiaireController::class, 'rejeter'])->name('stagiaire.rejeter');
    Route::post('/stagiaires/{stagiaire}/attestation', [Admin\StagiaireController::class, 'genererAttestation'])->name('stagiaire.attestation');
    Route::get('/encadreurs', [Admin\EncadreurController::class, 'index'])->name('encadreurs');
    Route::get('/encadreurs/create', [Admin\EncadreurController::class, 'create'])->name('encadreur.create');
    Route::post('/encadreurs', [Admin\EncadreurController::class, 'store'])->name('encadreur.store');
    Route::delete('/encadreurs/{encadreur}', [Admin\EncadreurController::class, 'destroy'])->name('encadreur.destroy');
    Route::get('/budget', [Admin\BudgetController::class, 'index'])->name('budget');
    Route::post('/budget/paiements/{paiement}/valider', [Admin\BudgetController::class, 'validerPaiement'])->name('paiement.valider');
    Route::get('/rapports', [Admin\RapportController::class, 'index'])->name('rapports');
    Route::get('/rapports/stagiaires', [Admin\RapportController::class, 'exportStagiaires'])->name('rapports.stagiaires');
});
