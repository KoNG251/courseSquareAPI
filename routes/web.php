<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\member\memberController;
use App\Http\Controllers\course\courseController;
use App\Http\Controllers\enroll\enrollController;

// for member

Route::get('members', [MemberController::class, 'getMember']);

Route::get('members/{m_id}', [MemberController::class, 'getSpecificMember']);

Route::post('members',[MemberController::class, 'createMember'])
->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::put('members/{m_id}', [MemberController::class, 'updateMember'])
->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::delete('members/{m_id}', [MemberController::class, 'deleteMember'])
->where('m_id', '[0-9]+')
->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);


// for course
Route::get('courses', [courseController::class, 'getAllCourse']);
Route::get('courses/{c_id}', [courseController::class, 'getSpecificCourse']);

Route::post('courses', [courseController::class, 'createCourse'])
->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::put('courses/{c_id}', [courseController::class, 'updateCourse'])
->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::delete('courses/{c_id}', [courseController::class, 'deleteCourse'])
->where('c_id', '[0-9]+')
->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

// for enroll
Route::get('enrolls', [enrollController::class, 'getAllEnroll']);
Route::get('enrolls/{e_id}', [enrollController::class, 'getSpecificEnroll']);

Route::post('enrolls', [enrollController::class, 'createEnroll'])
->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::put('enrolls/{cer_id}', [enrollController::class, 'updateEnroll'])
->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::delete('enrolls/{cer_id}', [enrollController::class, 'deleteEnroll'])
->where('cer_id', '[0-9]+')
->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::get('enrolls/member/{m_id}', [enrollController::class, 'getEnrollByMember']);
Route::get('enrolls/course/{c_id}', [enrollController::class, 'getEnrollByCourse']);