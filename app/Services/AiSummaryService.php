<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AiSummaryService
{
    public function generateSummary(array $recentMoods, ?string $lastSummary = null): string
    {
        $moodList = collect($recentMoods)
            ->map(fn($day) => "{$day['date']}: {$day['mood']}")
            ->join("\n");

        $context = $lastSummary
            ? "Your previous reflection was: \"{$lastSummary}\"\n\nNow here are the latest moods:\n\n{$moodList}"
            : "Here are my moods over the last 30 days:\n\n{$moodList}";

        $response = Http::withHeaders([
            'x-api-key'         => config('services.ai.key'),
            'anthropic-version' => '2023-06-01',
            'content-type'      => 'application/json',
        ])->post('https://api.anthropic.com/v1/messages', [
            'model'      => 'claude-haiku-4-5-20251001',
            'max_tokens' => 150,
            'messages'   => [
                [
                    'role'    => 'user',
                    'content' => $context,
                ]
            ],
            'system' => 'You are a warm and supportive wellbeing assistant. Reflect on the users mood patterns in 1-2 sentences only. If given a previous reflection, build on it rather than repeating it. Be encouraging, non-judgmental, and point out any positive patterns. Never be clinical or alarming. Keep it concise.',
        ]);

        return $response->json('content.0.text') ?? 'Unable to generate summary.';
    }
}
