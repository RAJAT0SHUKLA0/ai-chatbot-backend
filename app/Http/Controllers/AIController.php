<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    public function askAI(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string',
        ]);

        $prompt = $request->input('prompt');

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post(env('OPENAI_API_BASE', 'https://openrouter.ai/api/v1') . '/chat/completions', [
                'model' => 'gpt-3.5-turbo', // you can also try 'gpt-4-turbo'
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

            $data = $response->json();

            if (isset($data['choices'][0]['message']['content'])) {
                return response()->json([
                    'reply' => $data['choices'][0]['message']['content']
                ]);
            }

            return response()->json([
                'error' => 'AI request failed',
                'message' => $data
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'AI request failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
