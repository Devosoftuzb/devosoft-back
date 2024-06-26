<?php

use App\Http\Controllers\AdvantageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryPortfolioController;
use App\Http\Controllers\CategoryServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PartnershipController;
use App\Http\Controllers\PortfolioCategoryController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


// Route::group(['middleware' => ["auth:sanctum",]], function () {

    Route::get('/portfolio__categories/{portfolio_category}/portfolios', [CategoryPortfolioController::class, 'getProjectsByCategory']);

    Route::apiResources([
        'user' => UserController::class,
        'teams' => TeamController::class,
        'services' => ServiceController::class,
        'contacts' => ContactController::class,
        'categories' => CategoryController::class,
        'portfolios' => PortfolioController::class,
        'advantages' => AdvantageController::class,
        'partnerships' => PartnershipController::class,
        'categories.services' => CategoryServiceController::class,
        'portfolio__categories' => PortfolioCategoryController::class,
    ]); 

// });


