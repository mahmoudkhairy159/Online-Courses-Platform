<?php

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

Route::group([

    'prefix' => 'v1',
    'namespace' => 'API',

], function ($router) {
//below routes are public, user can acces it without any restirction
    Route::group(['prefix' => 'auth'], function () {
        Route::group(['prefix' => 'teacher'], function () {
            Route::post('register', 'TeachersController@register');
            Route::post('login', 'TeachersController@login');
            //refresh jwt token
            Route::post('refresh', 'TeachersController@refresh');
        });
        Route::group(['prefix' => 'student'], function () {
            Route::post('register', 'StudentsController@register');
            Route::post('login', 'StudentsController@login');
            //refresh jwt token
            Route::post('refresh', 'StudentsController@refresh');
        });
    });

//below routes are only available for the Authenticated users
    Route::group(['middleware' => 'auth:teacher-api', 'prefix' => 'auth'], function () {
        Route::group(['prefix' => 'teacher'], function () {
            Route::post('logout', 'TeachersController@logout');
            //get user info
            Route::get('teacher', 'TeachersController@teacher');
        });
    });
    Route::group(['middleware' => 'auth:student-api', 'prefix' => 'auth'], function () {
        Route::group(['prefix' => 'student' ], function () {
            Route::post('logout', 'StudentsController@logout');
            //get user info
            Route::get('student', 'StudentsController@student');
        });
    });

});
