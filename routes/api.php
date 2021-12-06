<?php

use App\Http\Controllers\FileStorage\FileStorageController;
use App\Http\Controllers\Homeworks\HomeworkController;
use App\Http\Controllers\Homeworks\SolutionController;
use App\Http\Controllers\Homeworks\SolutionFileController;
use App\Http\Controllers\Lessons\LessonController;
use App\Http\Controllers\Lessons\LessonTypeController;
use App\Http\Controllers\Schedule\ScheduleController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\WeekDays\WeekDayController;
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
//Unauthorized routes//
Route::middleware('auth:sanctum')->group(function ()
{
    Route::group(['prefix' => 'v1'], function ()
    {
        //Authorized routes//
            //Primitives//
        Route::apiResource('file-storage', FileStorageController::class)->only(['show','store','destroy']);
        Route::apiResource('week-days', WeekDayController::class)->only(['index','show']);
        Route::apiResource('lessons', LessonController::class)->only(['index','show']);
        Route::apiResource('lesson-types', LessonTypeController::class)->only(['index','show']);

        Route::get('/profile', [UserController::class, 'show']);
        Route::get('/profile/{id}', [UserController::class, 'show']);

            //Complex//
        Route::apiResource('schedule', ScheduleController::class)->only(['index','show']);
        Route::apiResource('homeworks', HomeworkController::class)->only(['index','show']);
        Route::apiResource('solutions', SolutionController::class);
        Route::apiResource('solution-files', SolutionFileController::class)->except(['update']);

        //Privileged routes//
        Route::middleware('role:moderator,admin')->group(function ()
        {
                //Primitives//
            Route::apiResource('file-storage', FileStorageController::class)->except(['show','store','destroy']);
            Route::apiResource('week-days', WeekDayController::class)->except(['index','show']);
            Route::apiResource('lessons', LessonController::class)->except(['index','show']);
            Route::apiResource('lesson-types', LessonTypeController::class)->except(['index','show']);

                //Complex//
            Route::apiResource('schedule', ScheduleController::class)->except(['index','show']);
            Route::apiResource('homeworks', HomeworkController::class)->except(['index','show']);
//            Route::apiResource('solution-files', []);

//            Route::middleware('role:admin')->group(function ()
//            {
//                Route::apiResource('roles', []);
//                Route::apiResource('users', []);
//            });
        });
    });
});

