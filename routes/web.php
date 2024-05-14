<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;


Route::post('authenticate', [UserController::class, 'authenticate']);

Route::resource('items', ItemController::class)->only([
    'show'
]);

Route::resource('carts', CartController::class)->only([
    'index', 'store', 'destroy'
])->middleware('auth');

Route::get("/test-me", function () {
    return 'Hello from Laravel!';
});



Route::get('/{vue_capture?}', function () {
    return view('welcome');
})->where('vue_capture', '[\/\w\.-]*');