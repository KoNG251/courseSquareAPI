<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\member\memberController;

Route::get('members', [MemberController::class, 'getMember']);