<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SoccerController extends Controller
{
    /**
     * Display the soccer homepage
     */
    public function index()
    {
        return view('soccer.index');
    }

    /**
     * Display information about the soccer ball 3D model
     */
    public function ball()
    {
        return response()->json([
            'message' => 'Soccer Ball 3D Model',
            'file' => 'footballsoccer_ball.glb',
            'description' => 'A 3D model of a soccer ball available in this application',
            'format' => 'GLB (GL Transmission Format Binary)',
            'size' => '1.8MB',
            'features' => [
                'High-quality 3D geometry',
                'Realistic textures',
                'Optimized for web display',
                'Compatible with Three.js'
            ]
        ]);
    }

    /**
     * Display teams management page
     */
    public function teams()
    {
        return view('soccer.teams');
    }

    /**
     * Get teams data API
     */
    public function teamsData()
    {
        $teams = [
            [
                'id' => 1,
                'name' => 'Barcelona FC',
                'founded' => 1899,
                'players' => 25,
                'country' => 'Spain',
                'stadium' => 'Camp Nou'
            ],
            [
                'id' => 2,
                'name' => 'Real Madrid',
                'founded' => 1902,
                'players' => 28,
                'country' => 'Spain',
                'stadium' => 'Santiago Bernabéu'
            ],
            [
                'id' => 3,
                'name' => 'Manchester United',
                'founded' => 1878,
                'players' => 26,
                'country' => 'England',
                'stadium' => 'Old Trafford'
            ]
        ];

        return response()->json([
            'teams' => $teams,
            'total_teams' => count($teams),
            'message' => 'Soccer teams data'
        ]);
    }

    /**
     * Display players management page
     */
    public function players()
    {
        return view('soccer.players');
    }

    /**
     * Get players data API
     */
    public function playersData()
    {
        $teams = [
            [
                'id' => 1,
                'name' => 'Barcelona FC',
                'founded' => 1899,
                'players' => 25,
                'country' => 'Spain',
                'stadium' => 'Camp Nou'
            ],
            [
                'id' => 2,
                'name' => 'Real Madrid',
                'founded' => 1902,
                'players' => 28,
                'country' => 'Spain',
                'stadium' => 'Santiago Bernabéu'
            ],
            [
                'id' => 3,
                'name' => 'Manchester United',
                'founded' => 1878,
                'players' => 26,
                'country' => 'England',
                'stadium' => 'Old Trafford'
            ]
        ];

        return response()->json([
            'teams' => $teams,
            'total_teams' => count($teams),
            'message' => 'Soccer teams data'
        ]);
    }

    /**
     * Display players management page
     */
    public function players()
    {
    /**
     * Get players data API
     */
    public function playersData()
    {
        $players = [
            [
                'id' => 1,
                'name' => 'Lionel Messi',
                'position' => 'Forward',
                'age' => 36,
                'team' => 'Inter Miami',
                'goals' => 808,
                'nationality' => 'Argentina'
            ],
            [
                'id' => 2,
                'name' => 'Cristiano Ronaldo',
                'position' => 'Forward',
                'age' => 39,
                'team' => 'Al Nassr',
                'goals' => 895,
                'nationality' => 'Portugal'
            ],
            [
                'id' => 3,
                'name' => 'Kylian Mbappé',
                'position' => 'Forward',
                'age' => 25,
                'team' => 'Real Madrid',
                'goals' => 356,
                'nationality' => 'France'
            ]
        ];

        return response()->json([
            'players' => $players,
            'total_players' => count($players),
            'message' => 'Soccer players data'
        ]);
    }
    }

    /**
     * Display statistics API
     */
    public function stats()
    {
        return response()->json([
            'statistics' => [
                'total_teams' => 24,
                'total_players' => 486,
                'matches_played' => 132,
                'goals_scored' => 398,
                'average_goals_per_match' => round(398 / 132, 2),
                'top_scorer' => 'Cristiano Ronaldo',
                'most_successful_team' => 'Barcelona FC'
            ],
            'last_updated' => now()->toISOString(),
            'message' => 'Soccer statistics data'
        ]);
    }
}
