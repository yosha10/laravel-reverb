<?php

use App\Http\Controllers\MessageController;
use App\Livewire\ChatComponent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/message", function (Request $request) {
    $message = $_POST['message'];
    $mqService = new \App\Services\RabbitMQService();
    $mqService->publish($message);
    return view('chat');
});

Route::post('callEvent', [MessageController::class, 'saveMessageEvent']);