<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Management - Soccer App</title>
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
        
        .teams-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .team-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            transition: transform 0.3s ease;
        }
        
        .team-card:hover {
            transform: translateY(-5px);
        }
        
        .team-name {
            color: #2c5530;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .team-info {
            margin-bottom: 0.5rem;
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
            <h1>🏆 Team Management</h1>
            <p>Manage your soccer teams and track their performance</p>
        </div>
        
        <div class="teams-grid" id="teams-container">
            <!-- Teams will be loaded here via JavaScript -->
        </div>
        
        <div style="text-align: center;">
            <a href="{{ route('soccer.index') }}" class="button">← Back to Home</a>
            <a href="{{ route('soccer.players') }}" class="button">View Players</a>
        </div>
    </div>

    <script>
        // Load teams data from API
        fetch('/soccer/api/teams')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('teams-container');
                container.innerHTML = data.teams.map(team => `
                    <div class="team-card">
                        <h3 class="team-name">${team.name}</h3>
                        <div class="team-info"><strong>Founded:</strong> ${team.founded}</div>
                        <div class="team-info"><strong>Players:</strong> ${team.players}</div>
                        <div class="team-info"><strong>Country:</strong> ${team.country}</div>
                        <div class="team-info"><strong>Stadium:</strong> ${team.stadium}</div>
                    </div>
                `).join('');
            })
            .catch(error => {
                console.error('Error loading teams:', error);
                document.getElementById('teams-container').innerHTML = 
                    '<p style="text-align: center; color: white;">Error loading teams data</p>';
            });
    </script>
</body>
</html>