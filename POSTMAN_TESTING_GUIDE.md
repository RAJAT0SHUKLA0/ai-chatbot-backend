# Postman Testing Guide

This guide shows you how to test the AI endpoint using Postman.

## Prerequisites

1. **Start the Laravel server:**
   ```bash
   php artisan serve
   ```
   Your server should be running at `http://localhost:8000`

2. **Set up your `.env` file** with at least OpenAI API key:
   ```env
   OPENAI_API_KEY=your-openai-api-key-here
   AI_ALTERNATIVE_PROVIDER=anthropic  # Optional: for fallback
   ANTHROPIC_API_KEY=your-anthropic-key  # Optional: for fallback
   ```

## Postman Setup

### Request 1: Basic AI Question

**Method:** `POST`

**URL:**
```
http://localhost:8000/api/ask-ai
```

**Headers:**
- `Content-Type`: `application/json`
- `Accept`: `application/json`

**Body (raw JSON):**
```json
{
  "prompt": "What is Laravel?"
}
```

**Expected Response:**
```json
{
  "reply": "Laravel is a PHP web framework...",
  "provider": "openai"
}
```

---

### Request 2: Testing Fallback (Simulate Rate Limit)

To test the fallback mechanism, you need to configure an alternative provider in your `.env`:

```env
AI_ALTERNATIVE_PROVIDER=anthropic
ANTHROPIC_API_KEY=your-anthropic-api-key
```

Or for local testing with Ollama:

```env
AI_ALTERNATIVE_PROVIDER=ollama
OLLAMA_BASE_URL=http://localhost:11434
OLLAMA_MODEL=llama2
```

When OpenAI rate limit is exceeded (or temporarily fails), you'll see:

```json
{
  "reply": "Response from alternative provider...",
  "provider": "anthropic",
  "fallback": true
}
```

---

## Step-by-Step Postman Instructions

### Step 1: Create New Request
1. Open Postman
2. Click **"New"** → **"HTTP Request"**
3. Name it: `AI Chat - Laravel`

### Step 2: Configure Request Method
- Select **POST** from the dropdown
- Enter URL: `http://localhost:8000/api/ask-ai`

### Step 3: Set Headers
1. Click on the **"Headers"** tab
2. Add these headers:
   - Key: `Content-Type`, Value: `application/json`
   - Key: `Accept`, Value: `application/json`

### Step 4: Add Request Body
1. Click on the **"Body"** tab
2. Select **"raw"** option
3. Choose **"JSON"** from the dropdown (right side)
4. Enter the request body:
   ```json
   {
     "prompt": "Hello, how are you?"
   }
   ```

### Step 5: Send Request
1. Click **"Send"** button
2. Check the response below

---

## Sample Requests

### Request: Simple Question
```json
{
  "prompt": "Explain what is PHP in one sentence"
}
```

### Request: Technical Question
```json
{
  "prompt": "What is the difference between Laravel and Symfony?"
}
```

### Request: Code Suggestion
```json
{
  "prompt": "How do I create a RESTful API in Laravel?"
}
```

### Request: Long Prompt
```json
{
  "prompt": "Write a short explanation about API authentication with JWT tokens in Laravel"
}
```

---

## Expected Responses

### Success Response (OpenAI Working)
```json
{
  "reply": "Your answer will appear here...",
  "provider": "openai"
}
```

### Fallback Response (Using Alternative Provider)
```json
{
  "reply": "Your answer from the fallback provider...",
  "provider": "anthropic",
  "fallback": true
}
```

### Error Response (Both Providers Failed)
```json
{
  "error": "AI request failed",
  "message": "Error details here...",
  "provider": "unknown"
}
```

### Validation Error (Missing Prompt)
```json
{
  "message": "The prompt field is required.",
  "errors": {
    "prompt": [
      "The prompt field is required."
    ]
  }
}
```

---

## Troubleshooting

### Error: "Connection Refused"
- Make sure Laravel server is running: `php artisan serve`
- Check the URL is correct: `http://localhost:8000/api/ask-ai`

### Error: "419 CSRF Token Mismatch"
- API routes don't require CSRF tokens, so this shouldn't happen
- If it does, check your `routes/api.php` file

### Error: "AI request failed"
- Check your `.env` file has valid API keys
- Verify `OPENAI_API_KEY` is set
- Check Laravel logs: `storage/logs/laravel.log`

### Error: "Rate limit exceeded"
- This will automatically trigger fallback if configured
- Or wait for the rate limit to reset
- Consider upgrading your OpenAI plan

---

## Advanced: Testing Fallback Behavior

To test what happens when OpenAI is unavailable:

1. **Option A:** Temporarily set an invalid OpenAI API key in `.env`
2. **Option B:** Configure Ollama (local, free):
   ```bash
   # Install Ollama
   curl https://ollama.ai/install.sh | sh
   
   # Pull a model
   ollama pull llama2
   
   # Start Ollama server
   ollama serve
   ```
3. **Option C:** Use Anthropic (requires API key)

Then your fallback will be automatically used.

---

## Quick Test Collection

Create these requests in Postman:

1. **Test 1 - Hello**
   - Prompt: `"Say hello"`
   
2. **Test 2 - Explain**
   - Prompt: `"What is artificial intelligence?"`
   
3. **Test 3 - Code Help**
   - Prompt: `"How do I validate input in Laravel?"`

4. **Test 4 - Long Question**
   - Prompt: `"Explain the MVC pattern in Laravel framework"`

---

## Export/Import

You can export your Postman collection:
1. Click **"..."** (three dots) → **"Export"**
2. Choose **"Collection v2.1"**
3. Share with your team

To import:
1. Click **"Import"**
2. Select your exported JSON file

---

## Environment Variables in Postman

Set up environment variables in Postman for easier testing:

1. Click on **"Environments"** → **"+"**
2. Create new environment: `Laravel Local`
3. Add variables:
   - `base_url`: `http://localhost:8000`
   - `api_token`: `your-api-token` (if using authentication)

Use in URL: `{{base_url}}/api/ask-ai`

