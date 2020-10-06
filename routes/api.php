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
            Route::post('register', 'TeacherController@register');
            Route::post('login', 'TeacherController@login');
            //refresh jwt token
            Route::post('refresh', 'TeacherController@refresh');
        });
        Route::group(['prefix' => 'student'], function () {
            Route::post('register', 'StudentController@register');
            Route::post('login', 'StudentController@login');
            //refresh jwt token
            Route::post('refresh', 'StudentController@refresh');
        });
    });

//below routes are only available for the Authenticated users
    Route::group(['middleware' => 'auth:teacher-api', 'prefix' => 'auth'], function () {
        Route::group(['prefix' => 'teacher'], function () {
            Route::post('logout', 'TeacherController@logout');
            //get user info
            Route::get('teacher', 'TeacherController@teacher');
        });
    });
    Route::group(['middleware' => 'auth:student-api', 'prefix' => 'auth'], function () {
        Route::group(['prefix' => 'student' ], function () {
            Route::post('logout', 'StudentController@logout');
            //get user info
            Route::get('student', 'StudentController@student');
        });
    });

    Route::apiResource('courses', 'CourseController');
    Route::apiResource('lessons', 'LessonController');


});
