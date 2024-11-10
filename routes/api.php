<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategorieController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Route pour afficher toutes les catégories
Route::get('categorie/index', [CategorieController::class, 'index']);

// Route pour créer une nouvelle catégorie
Route::post('categorie/store', [CategorieController::class, 'store']);

// Route pour afficher une catégorie spécifique
Route::get('categorie/show/{id}', [CategorieController::class, 'show']);

// Route pour mettre à jour une catégorie (via GET pour le test mais généralement mis en PUT)
Route::post('categorie/update/{id}', [CategorieController::class, 'update']);

// Route pour supprimer une catégorie (via GET pour le test mais généralement mis en DELETE)
Route::post('categorie/delete/{id}', [CategorieController::class, 'delete']);




// Route pour afficher tous les posts
Route::get('post/index', [PostController::class, 'index']);

// Route pour créer un post
Route::post('post/store', [PostController::class, 'store']);

// Route pour afficher un post spécifique
Route::get('post/show/{id}', [PostController::class, 'show']);

// Route pour mettre à jour un post (via GET pour le test mais généralement mis en PUT)
Route::post('post/update/{id}', [PostController::class, 'update']);

// Route pour supprimer un post (via GET pour le test mais généralement mis en DELETE)
Route::post('post/delete/{id}', [PostController::class, 'delete']);
