<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlsController;

// affichage de la vue welcome par defaut
Route::get('/', [UrlsController::class, 'create']);

// post de l'url puis verification de l'url dans la base de donnees
Route::post('/', [UrlsController::class, 'store']);

// quand on clique sur l'url raccourci on redirige vers l'url par defaut qui a ete initialement entree
Route::get('/{shortened}', [UrlsController::class, 'show']);
