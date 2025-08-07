<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Management - Soccer App</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            color: #333;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            background: linear-gradient(135deg, #2c5530 0%, #4a7c59 100%);
            color: white;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        
        .players-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .player-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transition: transform 0.3s ease;
        }
        
        .player-card:hover {
            transform: translateY(-5px);
        }
        
        .player-name {
            color: #2c5530;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .player-info {
            margin-bottom: 0.5rem;
        }
        
        .goals-badge {
            background: #2c5530;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.9rem;
            display: inline-block;
            margin-top: 1rem;
        }
        
        .button {
            background: linear-gradient(135deg, #2c5530 0%, #4a7c59 100%);
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            display: inline-block;
            margin: 10px 5px;
            transition: all 0.3s ease;
        }
        
        .button:hover {
            background: linear-gradient(135deg, #1e3e22 0%, #2c5530 100%);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>👥 Player Management</h1>
            <p>Track player statistics and performance</p>
        </div>
        
        <div class="players-grid" id="players-container">
            <!-- Players will be loaded here via JavaScript -->
        </div>
        
        <div style="text-align: center;">
            <a href="{{ route('soccer.index') }}" class="button">← Back to Home</a>
            <a href="{{ route('soccer.teams') }}" class="button">View Teams</a>
        </div>
    </div>

    <script>
        // Load players data from API
        fetch('/soccer/api/players')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('players-container');
                container.innerHTML = data.players.map(player => `
                    <div class="player-card">
                        <h3 class="player-name">${player.name}</h3>
                        <div class="player-info"><strong>Position:</strong> ${player.position}</div>
                        <div class="player-info"><strong>Age:</strong> ${player.age}</div>
                        <div class="player-info"><strong>Team:</strong> ${player.team}</div>
                        <div class="player-info"><strong>Nationality:</strong> ${player.nationality}</div>
                        <div class="goals-badge">⚽ ${player.goals} Goals</div>
                    </div>
                `).join('');
            })
            .catch(error => {
                console.error('Error loading players:', error);
                document.getElementById('players-container').innerHTML = 
                    '<p style="text-align: center; color: white;">Error loading players data</p>';
            });
    </script>
</body>
</html>