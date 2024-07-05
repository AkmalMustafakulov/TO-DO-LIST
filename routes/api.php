<?php

use App\Http\Controllers\TodoListController;
use App\Http\Controllers\TestUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/registration', [TestUserController::class, 'store']);
Route::post('/login', [TestUserController::class, 'login']);
Route::get('/logout', [TestUserController::class, 'logout']);

Route::get('/todo_list', [TodoListController::class, 'index'])->middleware('MyAuth');
Route::post('/todo_list', [TodoListController::class, 'store']);
Route::post('/update/{todo_list}', [TodoListController::class, 'update']);
Route::get('/delete/{todo_list}', [TodoListController::class, 'destroy']);