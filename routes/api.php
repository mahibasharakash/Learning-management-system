<?php

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

use App\Http\Controllers\Api\AdminApi\AdminAuthController,
    \App\Http\Controllers\Api\AdminApi\EventController,
    \App\Http\Controllers\Api\AdminApi\TutorController,
    \App\Http\Controllers\Api\AdminApi\StudentController,
    \App\Http\Controllers\Api\AdminApi\CourseController,
    \App\Http\Controllers\Api\AdminApi\LibraryAssetsController,
    \App\Http\Controllers\Api\AdminApi\DepartmentController,
    \App\Http\Controllers\Api\AdminApi\GeneralController,
    \App\Http\Controllers\Api\AdminApi\StaffController,
    \App\Http\Controllers\Api\AdminApi\HolidayController,
    \App\Http\Controllers\Api\AdminApi\FeesController
    ;

Route::prefix('admin')->group(function () {

    Route::post('/login', [AdminAuthController::class, 'Login'])->name('AUTH.LOGIN.API');
    Route::post('/forgot', [AdminAuthController::class, 'Forgot'])->name('AUTH.FORGOT.API');
    Route::post('/reset', [AdminAuthController::class, 'Reset'])->name('AUTH.RESET.API');

    Route::middleware('auth:sanctum')->group(function () {

        Route::prefix('profile')->group(function() {
            Route::get('/details', [AdminAuthController::class, 'Details'])->name('PROFILE.DETAILS.API');
            Route::post('/change-details', [AdminAuthController::class, 'ChangeDetails'])->name('PROFILE.CHANGE.DETAILS.API');
            Route::post('/change-password', [AdminAuthController::class, 'ChangePassword'])->name('PROFILE.CHANGE.PASSWORD.API');
            Route::post('/logout', [AdminAuthController::class, 'Logout'])->name('PROFILE.LOGOUT.API');
        });

    });

    Route::prefix('general')->group(function () {
        Route::get('tutor', [GeneralController::class, 'tutor'])->name('GENERAL.ALL.TUTOR.API');
        Route::get('department', [GeneralController::class, 'department'])->name('GENERAL.ALL.DEPARTMENT.API');
        Route::get('course', [GeneralController::class, 'course'])->name('GENERAL.ALL.COURSE.API');
        Route::get('student', [GeneralController::class, 'student'])->name('GENERAL.ALL.STUDENT.API');
    });

    Route::prefix('event')->group(function () {
        Route::get('list', [EventController::class, 'index'])->name('EVENT.LIST.API');
        Route::post('store', [EventController::class, 'store'])->name('EVENT.STORE.API');
        Route::post('show/{id}', [EventController::class, 'show'])->name('EVENT.SHOW.API');
        Route::put('update/{id}', [EventController::class, 'update'])->name('EVENT.UPDATE.API');
        Route::delete('delete/{id}', [EventController::class, 'delete'])->name('EVENT.DELETE.API');
    });

    Route::prefix('tutor')->group(function () {
        Route::get('', [TutorController::class, 'index'])->name('TUTOR.LIST.API');
        Route::post('store', [TutorController::class, 'store'])->name('TUTOR.STORE.API');
        Route::get('show/{id}', [TutorController::class, 'show'])->name('TUTOR.SHOW.API');
        Route::put('update/{id}', [TutorController::class, 'update'])->name('TUTOR.UPDATE.API');
        Route::delete('delete/{id}', [TutorController::class, 'destroy'])->name('TUTOR.DELETE.API');
        Route::post('truncate', [TutorController::class, 'clear'])->name('TUTOR.DELETE.API');
    });

    Route::prefix('student')->group(function () {
        Route::get('', [StudentController::class, 'index'])->name('STUDENT.LIST.API');
        Route::post('store', [StudentController::class, 'store'])->name('STUDENT.STORE.API');
        Route::get('show/{id}', [StudentController::class, 'show'])->name('STUDENT.SHOW.API');
        Route::put('update/{id}', [StudentController::class, 'update'])->name('STUDENT.UPDATE.API');
        Route::delete('delete/{id}', [StudentController::class, 'destroy'])->name('STUDENT.DELETE.API');
        Route::post('truncate', [StudentController::class, 'clear'])->name('STUDENT.DELETE.API');
    });

    Route::prefix('course')->group(function () {
        Route::get('', [CourseController::class, 'index'])->name('COURSE.LIST.API');
        Route::post('store', [CourseController::class, 'store'])->name('COURSE.STORE.API');
        Route::get('show/{id}', [CourseController::class, 'show'])->name('COURSE.SHOW.API');
        Route::put('update/{id}', [CourseController::class, 'update'])->name('COURSE.UPDATE.API');
        Route::delete('delete/{id}', [CourseController::class, 'destroy'])->name('COURSE.DELETE.API');
        Route::post('truncate', [CourseController::class, 'clear'])->name('COURSE.DELETE.API');
    });

    Route::prefix('library-assets')->group(function () {
        Route::get('', [LibraryAssetsController::class, 'index'])->name('LIBRARY.ASSETS.LIST.API');
        Route::post('store', [LibraryAssetsController::class, 'store'])->name('LIBRARY.ASSETS.STORE.API');
        Route::get('show/{id}', [LibraryAssetsController::class, 'show'])->name('LIBRARY.ASSETS.SHOW.API');
        Route::put('update/{id}', [LibraryAssetsController::class, 'update'])->name('LIBRARY.ASSETS.UPDATE.API');
        Route::delete('delete/{id}', [LibraryAssetsController::class, 'destroy'])->name('LIBRARY.ASSETS.DELETE.API');
        Route::post('truncate', [LibraryAssetsController::class, 'clear'])->name('LIBRARY.ASSETS.DELETE.API');
    });

    Route::prefix('department')->group(function () {
        Route::get('', [DepartmentController::class, 'index'])->name('DEPARTMENT.LIST.API');
        Route::post('store', [DepartmentController::class, 'store'])->name('DEPARTMENT.STORE.API');
        Route::get('show/{id}', [DepartmentController::class, 'show'])->name('DEPARTMENT.SHOW.API');
        Route::put('update/{id}', [DepartmentController::class, 'update'])->name('DEPARTMENT.UPDATE.API');
        Route::delete('delete/{id}', [DepartmentController::class, 'destroy'])->name('DEPARTMENT.DELETE.API');
        Route::post('truncate', [DepartmentController::class, 'clear'])->name('DEPARTMENT.DELETE.API');
    });

    Route::prefix('staff')->group(function () {
        Route::get('', [StaffController::class, 'index'])->name('STAFF.LIST.API');
        Route::post('store', [StaffController::class, 'store'])->name('STAFF.STORE.API');
        Route::get('show/{id}', [StaffController::class, 'show'])->name('STAFF.SHOW.API');
        Route::put('update/{id}', [StaffController::class, 'update'])->name('STAFF.UPDATE.API');
        Route::delete('delete/{id}', [StaffController::class, 'destroy'])->name('STAFF.DELETE.API');
        Route::post('truncate', [StaffController::class, 'clear'])->name('STAFF.DELETE.API');
    });

    Route::prefix('holiday')->group(function () {
        Route::get('', [HolidayController::class, 'index'])->name('HOLIDAY.LIST.API');
        Route::post('store', [HolidayController::class, 'store'])->name('HOLIDAY.STORE.API');
        Route::get('show/{id}', [HolidayController::class, 'show'])->name('HOLIDAY.SHOW.API');
        Route::put('update/{id}', [HolidayController::class, 'update'])->name('HOLIDAY.UPDATE.API');
        Route::delete('delete/{id}', [HolidayController::class, 'destroy'])->name('HOLIDAY.DELETE.API');
        Route::post('truncate', [HolidayController::class, 'clear'])->name('HOLIDAY.DELETE.API');
    });

    Route::prefix('fees')->group(function () {
        Route::get('', [FeesController::class, 'index'])->name('FEES.LIST.API');
        Route::post('store', [FeesController::class, 'store'])->name('FEES.STORE.API');
        Route::get('show/{id}', [FeesController::class, 'show'])->name('FEES.SHOW.API');
        Route::put('update/{id}', [FeesController::class, 'update'])->name('FEES.UPDATE.API');
        Route::delete('delete/{id}', [FeesController::class, 'destroy'])->name('FEES.DELETE.API');
        Route::post('truncate', [FeesController::class, 'clear'])->name('FEES.DELETE.API');
    });

});

use App\Http\Controllers\Api\TutorApi\TutorAuthController;

Route::prefix('tutor')->group(function () {

    Route::post('/login', [TutorAuthController::class, 'Login']);
    Route::post('/register', [TutorAuthController::class, 'Registration']);
    Route::post('/forgot', [TutorAuthController::class, 'Forgot']);
    Route::post('/reset', [TutorAuthController::class, 'Reset']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('profile')->group(function() {
            Route::get('/details', [TutorAuthController::class, 'Details']);
            Route::post('/change-details', [TutorAuthController::class, 'ChangeDetails']);
            Route::post('/change-password', [TutorAuthController::class, 'ChangePassword']);
            Route::post('/logout', [TutorAuthController::class, 'Logout']);
        });
    });

});

use App\Http\Controllers\Api\StudentApi\StudentAuthController;

Route::prefix('student')->group(function () {

    Route::post('/login', [StudentAuthController::class, 'Login']);
    Route::post('/register', [StudentAuthController::class, 'Registration']);
    Route::post('/forgot', [StudentAuthController::class, 'Forgot']);
    Route::post('/reset', [StudentAuthController::class, 'Reset']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('profile')->group(function() {
            Route::get('/details', [StudentAuthController::class, 'Details']);
            Route::post('/change-details', [StudentAuthController::class, 'ChangeDetails']);
            Route::post('/change-password', [StudentAuthController::class, 'ChangePassword']);
            Route::post('/logout', [StudentAuthController::class, 'Logout']);
        });
    });

});
