# AI Fallback Setup Guide

This application now includes automatic fallback to alternative AI providers when OpenAI rate limits are exceeded.

## Features

- **Primary Provider**: OpenAI (default)
- **Fallback Providers**: Anthropic Claude, Ollama (local), or Google Gemini
- **Automatic Failover**: When OpenAI limits are reached, the system automatically falls back to your configured alternative

## Configuration

### 1. Environment Variables

Add the following to your `.env` file:

```env
# OpenAI Configuration (Required)
OPENAI_API_KEY=your-openai-api-key
OPENAI_MODEL=gpt-3.5-turbo

# Alternative Provider Configuration
AI_ALTERNATIVE_PROVIDER=anthropic

# Anthropic Claude Configuration (Recommended Alternative)
ANTHROPIC_API_KEY=your-anthropic-api-key
ANTHROPIC_MODEL=claude-3-5-sonnet-20241022

# Ollama Configuration (For Local AI)
OLLAMA_BASE_URL=http://localhost:11434
OLLAMA_MODEL=llama2

# Google Gemini Configuration (Alternative)
GEMINI_API_KEY=your-gemini-api-key
GEMINI_MODEL=gemini-pro
```

### 2. API Keys Setup

#### For Anthropic Claude (Recommended)
1. Visit https://console.anthropic.com/
2. Create an account and get your API key
3. Set `ANTHROPIC_API_KEY` in your `.env` file
4. Set `AI_ALTERNATIVE_PROVIDER=anthropic`

#### For Ollama (Local, Free)
1. Install Ollama from https://ollama.ai/
2. Run: `ollama pull llama2` (or any other model)
3. Start Ollama server
4. Set `AI_ALTERNATIVE_PROVIDER=ollama` in your `.env` file

#### For Google Gemini
1. Visit https://makersuite.google.com/app/apikey
2. Get your API key
3. Set `GEMINI_API_KEY` in your `.env` file
4. Set `AI_ALTERNATIVE_PROVIDER=gemini`

## How It Works

1. **Primary Request**: The system attempts to use OpenAI
2. **Rate Limit Detection**: If OpenAI throws a rate limit error, the system catches it
3. **Automatic Fallback**: The system automatically calls your configured alternative provider
4. **Response**: Returns the result with metadata indicating which provider was used

## Response Format

### Success (OpenAI)
```json
{
  "reply": "AI response here...",
  "provider": "openai"
}
```

### Success (Fallback)
```json
{
  "reply": "AI response from alternative provider...",
  "provider": "anthropic",
  "fallback": true
}
```

### Error
```json
{
  "error": "AI request failed",
  "message": "Error details...",
  "provider": "unknown"
}
```

## Usage

The API endpoint remains the same:

```bash
POST /api/ask-ai
Content-Type: application/json

{
  "prompt": "Your question here"
}
```

## Switching Providers

To switch your fallback provider, simply change the `AI_ALTERNATIVE_PROVIDER` in your `.env`:

- `anthropic` - Use Anthropic Claude
- `ollama` - Use Ollama (local)
- `gemini` - Use Google Gemini

## Testing

Test the fallback by temporarily disabling your OpenAI API key or hitting the rate limit. The system will automatically use your configured alternative.

## Support

- **Anthropic**: https://docs.anthropic.com/
- **Ollama**: https://github.com/ollama/ollama
- **Gemini**: https://ai.google.dev/docs

