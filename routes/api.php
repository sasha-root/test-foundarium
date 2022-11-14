<?php

use Illuminate\Support\Facades\Route;
use Api\Domain\Common\Middleware\ApiExceptionRenderMiddleware;

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


Route::middleware(['api', ApiExceptionRenderMiddleware::class])
    ->group(function () {
        Route::group(['namespace' => '\Api\UI\User\Http\Controllers'], function(){
            Route::get('users', 'FetchAllUserController');
            Route::post('users', 'CreateUserController');

            Route::group(['where' => ['user_id' => '[0-9]+']], function () {
                Route::get('users/{user_id}', 'FetchOneUserController');
                Route::put('users/{user_id}', 'UpdateUserController');
                Route::delete('users/{user_id}', 'DeleteUserController');
            });
        });

        Route::group(['namespace' => '\Api\UI\Car\Http\Controllers'], function(){
            Route::get('cars', 'FetchAllCarController');
            Route::post('cars', 'CreateCarController');

            Route::group(['where' => ['car_id' => '[0-9]+']], function () {
                Route::get('cars/{car_id}', 'FetchOneCarController');
                Route::put('cars/{car_id}', 'UpdateCarController');
                Route::delete('cars/{car_id}', 'DeleteCarController');
            });
        });

        Route::group(['namespace' => '\Api\UI\CarRental\Http\Controllers'], function(){
            Route::get('cars-rental', 'FetchAllCarRentalController');
            Route::post('cars-rental', 'CreateCarRentalController');

            Route::group(['where' => ['car_id' => '[0-9]+']], function () {
                Route::delete('cars-rental/{car_rental_id}', 'DeleteCarRentalController');
            });
        });
    });
