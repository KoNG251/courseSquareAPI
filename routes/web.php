<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\member\memberController;

Route::get('members', [MemberController::class, 'getMember']);

Route::get('members/{m_id}', [MemberController::class, 'getSpecificMember']);

Route::post('members',[MemberController::class, 'createMember'])
->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::put('members/{m_id}', [MemberController::class, 'updateMember'])
->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);

Route::delete('members/{m_id}', [MemberController::class, 'deleteMember'])
->where('m_id', '[0-9]+')
->withoutMiddleware([Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class]);