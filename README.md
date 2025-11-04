# Laravel + React AI Backend

A Laravel backend application with AI integration and automatic fallback to alternative providers when rate limits are exceeded.

## Features

- **AI Chat Integration**: OpenAI GPT integration for intelligent conversations
- **Automatic Fallback**: Automatically switches to alternative AI providers when OpenAI limits are exceeded
- **Multiple AI Providers**: Support for OpenAI, Anthropic Claude, Ollama, and Google Gemini
- **RESTful API**: Clean API endpoints for AI interactions

## AI Provider Fallback

This application includes intelligent fallback logic that automatically uses alternative AI providers when OpenAI rate limits are exceeded:

1. **Primary**: OpenAI (default)
2. **Fallbacks**: Anthropic Claude, Ollama (local), or Google Gemini

When the OpenAI API hits rate limits, the system automatically falls back to your configured alternative provider, ensuring uninterrupted service.

For detailed setup instructions, see [AI_FALLBACK_SETUP.md](AI_FALLBACK_SETUP.md).

## Quick Start

1. Install dependencies:
```bash
composer install
npm install
```

2. Configure environment:
```bash
cp .env.example .env
php artisan key:generate
```

3. Add your API keys to `.env`:
```env
OPENAI_API_KEY=your-key-here
ANTHROPIC_API_KEY=your-key-here  # Optional, for fallback
AI_ALTERNATIVE_PROVIDER=anthropic
```

4. Run the application:
```bash
php artisan serve
npm run dev
```

## API Endpoints

- `POST /api/ask-ai` - Ask the AI a question
  - Request body: `{ "prompt": "Your question" }`
  - Response: `{ "reply": "AI response", "provider": "openai" }`

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
