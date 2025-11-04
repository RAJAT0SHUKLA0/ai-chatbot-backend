<?php

return [

    /*
    |--------------------------------------------------------------------------
    | AI Provider Configuration
    |--------------------------------------------------------------------------
    |
    | This file is for storing AI provider configuration settings.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Alternative Provider
    |--------------------------------------------------------------------------
    |
    | When OpenAI rate limits are exceeded, this provider will be used as
    | a fallback. Options: 'anthropic', 'ollama', 'gemini'
    |
    */

    'alternative_provider' => env('AI_ALTERNATIVE_PROVIDER', 'anthropic'),

];
