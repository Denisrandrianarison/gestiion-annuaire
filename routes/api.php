<?php
use App\Providers\RouteServiceProvider as Router;
use App\Http\Controllers\FicheController;
use App\Http\Controllers\CategoryController;

$router = new Router();

$router->get('/api/fetchFiche', FicheController::class, 'fetchFiche');
$router->post('/api/creatFiche/', FicheController::class, 'creatFiche');
/**
 * TODO: Recreate a new or fix PUT methode issue in RouteServiceProvider
 * (Currently use POST methode)
 * Ref:methode put issue
*/
$router->post('/api/updateFiche/', FicheController::class, 'updateFiche');
/**
 * TODO: Create a new or fix DELETE methode issue in RouteServiceProvider
 * (Currently use POST methode)
 * Ref:methode delete issue
*/
$router->post('/api/deleteFiche/{$id}', FicheController::class, 'deleteFiche');

$router->get('/api/fetchCategory', CategoryController::class, 'fetchCategory');
$router->post('/api/createCategory/', CategoryController::class, 'createCategory');
/**
 * TODO: Ref:methode put issue
*/
$router->post('/api/updateCategory/', CategoryController::class, 'updateCategory');
/**
 * TODO: Ref:methode delete issue
*/
$router->post('/api/deleteCategory/{$id}', CategoryController::class, 'deleteCategory');

$router->run();

