<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soccer Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            background: #2c5530;
            color: white;
            padding: 2rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }
        .feature {
            background: #f5f5f5;
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 5px;
            border-left: 4px solid #2c5530;
        }
        .button {
            background: #2c5530;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin: 10px 5px;
        }
        .button:hover {
            background: #1e3e22;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>⚽ Welcome to Soccer Application</h1>
        <p>Built with Laravel Framework</p>
    </div>

    <div class="feature">
        <h3>🏆 Features</h3>
        <ul>
            <li>Laravel 12.x Framework</li>
            <li>3D Soccer Ball Model Integration</li>
            <li>RESTful API Endpoints</li>
            <li>Modern PHP 8.3</li>
        </ul>
    </div>

    <div class="feature">
        <h3>🎮 Available Resources</h3>
        <p>This application includes a 3D soccer ball model and API endpoints for soccer-related functionality.</p>
        
        <a href="{{ route('soccer.ball') }}" class="button">View Ball API</a>
        <a href="{{ url('/') }}" class="button">Laravel Home</a>
    </div>

    <div class="feature">
        <h3>🔧 Getting Started</h3>
        <p>This Laravel application is ready for development:</p>
        <ul>
            <li>Run <code>php artisan serve</code> to start the development server</li>
            <li>Visit <code>/soccer</code> for this page</li>
            <li>Visit <code>/soccer/ball</code> for the API endpoint</li>
            <li>Edit files in <code>app/</code>, <code>resources/</code>, and <code>routes/</code></li>
        </ul>
    </div>
</body>
</html>