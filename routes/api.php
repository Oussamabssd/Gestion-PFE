<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\GererEnseignantController;
use App\Http\Controllers\Admin\GererSessionController;
use App\Http\Controllers\Enseignant\AuthController as EnseignantAuthController;
use App\Http\Controllers\Enseignant\GererDemandeController;
use App\Http\Controllers\Enseignant\GererThemeController;
use App\Http\Controllers\Etudiant\AuthController;
use App\Http\Controllers\Etudiant\BinomeController;
use App\Http\Controllers\Etudiant\FetchbinomeController as EtudiantFetchbinomeController;
use App\Http\Controllers\Etudiant\Fournir_PFE_Controller;
use App\Http\Controllers\Etudiant\GererPfeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// --------------admin--------------
//routes gerer admin
Route::post('login_admin', AdminAuthController::class. '@login' );
//routes gerer enseignant
Route::post('ajouter_enseignant', GererEnseignantController::class. '@AjouterEnseignant' );
Route::post('getAll_enseignant', GererEnseignantController::class. '@GetAllEnseignant' );
//routes gerer session
Route::post('/ouvrir_session' , GererSessionController::class. '@OuvrirSession');
Route::post('/fermer_session' , GererSessionController::class. '@FermerSession');
Route::post('/verifier_session' , GererSessionController::class. '@VerifierSession');

// --------------enseignant--------------
//routes gerer enseignant
Route::post('/login_enseignant' , EnseignantAuthController::class.'@login');
Route::post('/modifier_enseignant' , EnseignantAuthController::class.'@ModifierEnseignant');
//routes gerer themes
Route::post('/ajouter_theme' , GererThemeController::class.'@AjouterTheme');
Route::post('/modifier_theme' , GererThemeController::class.'@ModifierTheme');
Route::post('/supprimer_theme' , GererThemeController::class.'@SupprimerTheme');
Route::post('/get_all_themes' , GererThemeController::class.'@GetAllThemes');
//gerer demandes d'encadrement
Route::post('/getAll_demandes' , GererDemandeController::class.'@GetAllDemandes');
Route::post('/refuser_demande' , GererDemandeController::class.'@RefuserDemande');
Route::post('/accepter_demande' , GererDemandeController::class.'@AccepterDemande');
Route::post('/valider_PFE' , GererDemandeController::class.'@ValiderPFE');
Route::post('/rejouter_PFE' , GererDemandeController::class.'@RejouterPFE');

// --------------etudiant--------------
//routes gerer fetch binome
Route::post('/ajouter_fetch_binome' , EtudiantFetchbinomeController::class.'@AjouterFetchBinome');
Route::post('/modifier_fetch_binome' , EtudiantFetchbinomeController::class.'@ModifierFetchBinome');
Route::post('/supprimer_fetch_binome' , EtudiantFetchbinomeController::class.'@supprimerFetchBinome');
//routes gerer etudiant
Route::post('/register_etudiant' , AuthController::class.'@register');
Route::post('/login_etudiant' , AuthController::class.'@login');
Route::post('/modifier_etudiant' , AuthController::class.'@ModifierEtudiant');
//routes gerer binome
Route::post('/ajouter_binome' , BinomeController::class.'@AjouterBinome');
//routes gerer theme PFE
Route::post('/getAll_ens_themes' , GererPfeController::class.'@GetAllEnsThemes');
Route::post('/get_all_themes' , GererPfeController::class.'@GetAllThemes');
Route::post('/chercher_theme' , GererPfeController::class.'@ChercherTheme');
Route::post('/cherecher_enseignant' , GererPfeController::class.'@CherecherEnseignant');
Route::post('/envoyer_demande_encadrement' , GererPfeController::class.'@EnvoyerDemandeEncadrement');
Route::post('/proposer_PFE_externe' , GererPfeController::class.'@ProposerPFEexterne');
Route::post('/associer_encadrant_externe' , GererPfeController::class.'@AssocierEncadrantExterne');
//routes fournir la memoire de PFE
Route::post('/fournir_memoire' , Fournir_PFE_Controller::class.'@FournirMemoire');
