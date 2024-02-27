<?php

use App\Http\Controllers\category\CategoryController;
use App\Http\Controllers\Depenses\DepensesController;
use App\Http\Controllers\paiements\PaiementsController ;
use App\Http\Controllers\devises\DevisesController ;
use App\Http\Controllers\Users\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::group(['prefix'=>'/depenses'],function(){
    Route::get('/getDepenses',[DepensesController::class,'GetAll']);
    Route::delete('/deleteDepenses',[DepensesController::class,'deleteOne']);
});*/
Route::group(['prefix' => '/depenses'], function () {
    Route::get('/GetAllDepenses', [DepensesController::class, 'GetAllDepenses']);
    Route::post('/AddDepense', [DepensesController::class, 'AddDepense']);
    Route::post('/UpdateDepense/{id}', [DepensesController::class, 'UpdateDepense']);
    Route::get('/GetDepenseById/{id}', [DepensesController::class, 'GetDepenseById']);
    Route::delete('/DeleteDepense/{id}', [DepensesController::class, 'DeleteDepense']);
    Route::put('/accpetDepenses/{id}', [DepensesController::class, 'accpetDepenses']);
    Route::put('/RejectDepenses/{id}', [DepensesController::class, 'RejectDepenses']);
    Route::get('/MyLatestDepenses', [DepensesController::class, 'MyLatestDepenses']);
});
Route::group(['prefix'=>'/users'],function(){
    Route::get('/GetAll',[UsersController::class,'GetAll']);
    Route::delete('/deleteOne/{id}',[UsersController::class,'deleteOne']);
    Route::post('/updateOne/{id}',[CategoryController::class,'updateOne']);

});

Route::group(['prefix'=>'/category'],function(){
    Route::get('/GetAllCategory',[CategoryController::class,'GetAllCategory']);
    Route::post('/AddCategory',[CategoryController::class,'AddCategory']);
    Route::post('/UpdateCategory/{id}',[CategoryController::class,'UpdateCategory']);
    Route::get('/GetcategoryById/{id}',[CategoryController::class,'GetcategoryById']);
    Route::delete('/DeleteCategory/{id}',[CategoryController::class,'DeleteCategory']);
});

 Route::group(['prefix' => '/paiements'], function () {
    Route::get('/GetAllPaiements', [PaiementsController::class, 'GetAllPaiements']);
    Route::get('/GetPaiementById/{id}', [PaiementsController::class, 'GetPaiementById']);
    Route::post('/AddPaiement', [PaiementsController::class, 'AddPaiement']);
    Route::post('/UpdatePaiement/{id}', [PaiementsController::class, 'UpdatePaiement']);
    Route::delete('/DeletePaiement/{id}', [PaiementsController::class, 'DeletePaiement']);
}); 

Route::group(['prefix' => '/devises'], function () {
    Route::get('/GetAllDevises', [DevisesController::class, 'GetAllDevises']);
    Route::post('/AddDevise', [DevisesController::class, 'AddDevise']);
    Route::post('/UpdateDevise/{id}', [DevisesController::class, 'UpdateDevise']);
    Route::get('/GetDeviseById/{id}', [DevisesController::class, 'GetDeviseById']);
    Route::delete('/DeleteDevise/{id}', [DevisesController::class, 'DeleteDevise']);
});

Route::group(['prefix' => '/auth'], function () {
    Route::post('/singUp', [UsersController::class, 'singUp']);
    Route::post('/LoginUser', [UsersController::class, 'LoginUser']);
    Route::post('/forgot_password', [UsersController::class, 'forgot_password']);
    Route::post('/changer_password', [UsersController::class, 'changer_password']);
});