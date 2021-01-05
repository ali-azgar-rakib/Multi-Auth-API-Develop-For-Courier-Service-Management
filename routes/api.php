<?php

use App\Http\Controllers\API\Admin\AdminLoginController;
use App\Http\Controllers\API\Admin\BankController;
use App\Http\Controllers\API\Admin\ContactDetailsController;
use App\Http\Controllers\API\Admin\ServiceController;
use App\Http\Controllers\API\Admin\SetOpenTimeController;
use App\Http\Controllers\API\Admin\ShopCategoryController;
use App\Http\Controllers\API\Admin\SizeController;
use App\Http\Controllers\API\Admin\SliderController;
use App\Http\Controllers\API\Admin\ZoneController;
use App\Http\Controllers\API\Merchant\MerchantLoginController;
use App\Http\Controllers\API\Merchant\MerchantRegisterController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// admin route 
Route::prefix('admin')->group(function () {
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::middleware(['auth:admin-api'])->group(function () {
        Route::get('/info', [AdminLoginController::class, 'info']);
        Route::delete('/logout', [AdminLoginController::class, 'logout']);

        // api resource 
        Route::apiResources([
            'slider' => SliderController::class,
            'service' => ServiceController::class,
            'zone' => ZoneController::class,
            'size' => SizeController::class,
            'bank' => BankController::class,
            'shop-category' => ShopCategoryController::class,
            'contact-details' => ContactDetailsController::class,
            'open-time' => SetOpenTimeController::class,
        ]);
    });
});

// merchant route 

Route::prefix('merchant')->group(function () {
    Route::post('/register', [MerchantRegisterController::class, 'register']);
    Route::post('/login', [MerchantLoginController::class, 'login']);
    Route::middleware('auth:merchant-api')->group(function () {
        Route::get('/info', [MerchantLoginController::class, 'info']);
        Route::delete('/logout', [MerchantLoginController::class, 'logout']);
    });
});
