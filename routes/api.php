<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\EstimationController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/create/post', [PostController::class, 'create']); //создать пост
Route::get('/like/a/post', [EstimationController::class, 'like']); //поставить оценку посту
Route::get('/average/post/{post}', [PostController::class, 'averagePost']); //получить топ постов по среднему рейтенгу
Route::get('/login/ip', [PostController::class, 'listIp']); //получить список ip, с которых постило несколько разных авторов
