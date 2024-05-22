<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessageController extends Controller
{
    public function saveMessageEvent(Request $request) {
        MessageEvent::dispatch($request->input('id'), $request->input('message'));
        // // Suara TTS
        // sleep(3);
        // Http::withHeaders([
        //     "Accept" => "application/json",
        // ])->post("http://127.0.0.1:5000/text-to-speech", [
        //     "text" => $request->input('message')
        // ]);
        return response()->json(['success' => true]);
    }
}
