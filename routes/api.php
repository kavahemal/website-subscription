<?php

use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::post('/posts', [PostController::class, 'store']);
Route::post('/subscribe', [SubscriptionController::class, 'store']);

Route::get('/websites', [WebsiteController::class, 'index']);
Route::get('/subscribers', [SubscriptionController::class, 'index']);
