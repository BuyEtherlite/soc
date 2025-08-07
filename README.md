# ⚽ Soccer Application - Laravel Project

This is a Laravel application built from scratch for the BuyEtherlite/soc repository. The application includes soccer-themed functionality and integrates with a 3D soccer ball model.

![Soccer Application Screenshot](https://github.com/user-attachments/assets/f5b9dd92-bfed-42d4-b1a6-96b2f2987118)

## Features

- **Laravel 12.x Framework** - Latest Laravel framework with modern PHP 8.3
- **3D Soccer Ball Model Integration** - Includes footballsoccer_ball.glb 3D model
- **RESTful API Endpoints** - Soccer-themed API endpoints
- **Custom Soccer Controller** - Dedicated controller for soccer functionality
- **Responsive Design** - Clean, modern interface

## Installation & Setup

### Prerequisites
- PHP 8.3+
- Composer
- Node.js (optional, for frontend assets)

### Quick Start

1. **Install Dependencies**
   ```bash
   composer install
   ```

2. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. **Start Development Server**
   ```bash
   php artisan serve
   ```

4. **Visit the Application**
   - Main Laravel page: http://localhost:8000
   - Soccer application: http://localhost:8000/soccer
   - Soccer Ball API: http://localhost:8000/soccer/ball

## Application Routes

| Route | Method | Description |
|-------|--------|-------------|
| `/` | GET | Laravel welcome page |
| `/soccer` | GET | Soccer application homepage |
| `/soccer/ball` | GET | Soccer ball 3D model API endpoint |

## API Endpoints

### Soccer Ball Information
```http
GET /soccer/ball
```

**Response:**
```json
{
  "message": "Soccer Ball 3D Model",
  "file": "footballsoccer_ball.glb",
  "description": "A 3D model of a soccer ball available in this application"
}
```

## Project Structure

```
├── app/
│   └── Http/Controllers/
│       └── SoccerController.php    # Soccer-themed controller
├── resources/
│   └── views/
│       └── soccer/
│           └── index.blade.php     # Soccer application view
├── routes/
│   └── web.php                     # Web routes with soccer endpoints
├── footballsoccer_ball.glb         # 3D soccer ball model
└── a                               # Original repository file
```

## Development

### Running Tests
```bash
php artisan test
```

### Available Artisan Commands
```bash
php artisan route:list          # View all routes
php artisan make:controller     # Create new controller
php artisan make:model          # Create new model
php artisan serve              # Start development server
```

### Adding New Features

1. **Controllers**: Add new controllers in `app/Http/Controllers/`
2. **Views**: Add new Blade templates in `resources/views/`
3. **Routes**: Define new routes in `routes/web.php`
4. **Models**: Create models in `app/Models/`

## Technologies Used

- **Laravel Framework 12.x**
- **PHP 8.3**
- **Composer** for dependency management
- **Blade templating engine**
- **3D Model Integration** (GLB format)

## Contributing

This Laravel application is ready for further development. Feel free to:

- Add new soccer-related features
- Integrate the 3D model into web views
- Create additional API endpoints
- Implement database models for soccer data
- Add authentication and user management

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
