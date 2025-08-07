<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soccer Management App</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>
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
            padding: 3rem 2rem;
            border-radius: 15px;
            margin-bottom: 3rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        
        .header h1 {
            font-size: 3rem;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        
        .header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .main-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .feature-card {
            background: rgba(255, 255, 255, 0.95);
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            border: 1px solid rgba(255,255,255,0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        
        .feature-card h3 {
            color: #2c5530;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        
        .soccer-ball-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            grid-column: span 2;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        #soccer-ball-viewer {
            width: 100%;
            height: 400px;
            border-radius: 10px;
            background: linear-gradient(135deg, #87CEEB 0%, #98FB98 100%);
            border: 2px solid #2c5530;
        }
        
        .button {
            background: linear-gradient(135deg, #2c5530 0%, #4a7c59 100%);
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 8px;
            display: inline-block;
            margin: 10px 5px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(44, 85, 48, 0.3);
        }
        
        .button:hover {
            background: linear-gradient(135deg, #1e3e22 0%, #2c5530 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(44, 85, 48, 0.4);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin: 2rem 0;
        }
        
        .stat-item {
            background: rgba(255, 255, 255, 0.9);
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #2c5530;
        }
        
        .stat-label {
            color: #666;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
            }
            
            .soccer-ball-container {
                grid-column: span 1;
            }
            
            .header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>⚽ Soccer Management App</h1>
            <p>Professional Soccer Team & Player Management System</p>
        </div>

        <!-- Stats Overview -->
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">24</div>
                <div class="stat-label">Active Teams</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">486</div>
                <div class="stat-label">Registered Players</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">132</div>
                <div class="stat-label">Matches Played</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">98</div>
                <div class="stat-label">Goals Scored</div>
            </div>
        </div>

        <div class="main-content">
            <div class="feature-card">
                <h3>🏆 Team Management</h3>
                <p>Manage your soccer teams, track player rosters, and organize match schedules. Keep detailed records of team performance and statistics.</p>
                <ul style="margin: 1rem 0; padding-left: 1.5rem;">
                    <li>Team roster management</li>
                    <li>Player statistics tracking</li>
                    <li>Match scheduling</li>
                    <li>Performance analytics</li>
                </ul>
                <a href="{{ route('soccer.teams') }}" class="button">Manage Teams</a>
            </div>

            <div class="feature-card">
                <h3>👥 Player Profiles</h3>
                <p>Comprehensive player database with detailed profiles, statistics, and career tracking. Monitor player development and performance metrics.</p>
                <ul style="margin: 1rem 0; padding-left: 1.5rem;">
                    <li>Player profiles & stats</li>
                    <li>Career tracking</li>
                    <li>Performance metrics</li>
                    <li>Transfer management</li>
                </ul>
                <a href="{{ route('soccer.players') }}" class="button">View Players</a>
            </div>

            <!-- 3D Soccer Ball Viewer -->
            <div class="soccer-ball-container">
                <h3>⚽ Interactive 3D Soccer Ball</h3>
                <p>Explore our 3D soccer ball model with interactive controls</p>
                <div id="soccer-ball-viewer"></div>
                <div style="margin-top: 1rem;">
                    <button onclick="rotateBall()" class="button">Rotate Ball</button>
                    <button onclick="resetBall()" class="button">Reset View</button>
                    <a href="/soccer/api/ball" class="button">Ball API Data</a>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="feature-card">
                <h3>📊 Match Analytics</h3>
                <p>Advanced analytics and reporting tools for matches, player performance, and team statistics. Generate detailed reports and insights.</p>
                <a href="#" class="button">View Analytics</a>
                <a href="{{ url('/') }}" class="button">Laravel Home</a>
            </div>

            <div class="feature-card">
                <h3>🗓️ Schedule Management</h3>
                <p>Organize matches, training sessions, and events. Keep track of upcoming games and important dates in the soccer calendar.</p>
                <a href="#" class="button">View Schedule</a>
            </div>
        </div>
    </div>

    <script>
        // Three.js setup for 3D soccer ball
        let scene, camera, renderer, ball;
        let isRotating = false;

        function init3DViewer() {
            const container = document.getElementById('soccer-ball-viewer');
            
            // Scene setup
            scene = new THREE.Scene();
            scene.background = new THREE.Color(0x87CEEB);
            
            // Camera setup
            camera = new THREE.PerspectiveCamera(75, container.clientWidth / container.clientHeight, 0.1, 1000);
            camera.position.z = 3;
            
            // Renderer setup
            renderer = new THREE.WebGLRenderer({ antialias: true });
            renderer.setSize(container.clientWidth, container.clientHeight);
            renderer.shadowMap.enabled = true;
            renderer.shadowMap.type = THREE.PCFSoftShadowMap;
            container.appendChild(renderer.domElement);
            
            // Lighting
            const ambientLight = new THREE.AmbientLight(0x404040, 0.6);
            scene.add(ambientLight);
            
            const directionalLight = new THREE.DirectionalLight(0xffffff, 0.8);
            directionalLight.position.set(1, 1, 1);
            directionalLight.castShadow = true;
            scene.add(directionalLight);
            
            // Create a basic soccer ball geometry (placeholder for GLB model)
            const geometry = new THREE.SphereGeometry(1, 32, 16);
            
            // Soccer ball material with basic black and white pattern
            const material = new THREE.MeshPhongMaterial({
                color: 0xffffff,
                shininess: 30
            });
            
            ball = new THREE.Mesh(geometry, material);
            ball.castShadow = true;
            scene.add(ball);
            
            // Add some basic soccer ball patterns
            addSoccerBallPattern();
            
            // Animation loop
            animate();
            
            // Handle window resize
            window.addEventListener('resize', onWindowResize, false);
        }
        
        function addSoccerBallPattern() {
            // Add some black patches to simulate soccer ball pattern
            const patchGeometry = new THREE.SphereGeometry(1.01, 8, 6);
            const patchMaterial = new THREE.MeshPhongMaterial({ color: 0x000000 });
            
            for (let i = 0; i < 6; i++) {
                const patch = new THREE.Mesh(patchGeometry, patchMaterial);
                patch.position.set(
                    Math.sin(i * Math.PI / 3) * 0.8,
                    Math.cos(i * Math.PI / 3) * 0.8,
                    0
                );
                patch.scale.set(0.3, 0.3, 0.3);
                scene.add(patch);
            }
        }
        
        function animate() {
            requestAnimationFrame(animate);
            
            if (isRotating && ball) {
                ball.rotation.x += 0.01;
                ball.rotation.y += 0.02;
            }
            
            renderer.render(scene, camera);
        }
        
        function rotateBall() {
            isRotating = !isRotating;
        }
        
        function resetBall() {
            if (ball) {
                ball.rotation.set(0, 0, 0);
                isRotating = false;
            }
        }
        
        function onWindowResize() {
            const container = document.getElementById('soccer-ball-viewer');
            camera.aspect = container.clientWidth / container.clientHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(container.clientWidth, container.clientHeight);
        }
        
        // Initialize 3D viewer when page loads
        window.addEventListener('load', init3DViewer);
    </script>
</body>
</html>