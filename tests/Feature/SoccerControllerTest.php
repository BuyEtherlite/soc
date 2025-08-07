<?php

namespace Tests\Feature;

use Tests\TestCase;

class SoccerControllerTest extends TestCase
{
    /**
     * Test soccer homepage loads successfully
     */
    public function test_soccer_homepage_loads(): void
    {
        $response = $this->get('/soccer');
        
        $response->assertStatus(200);
        $response->assertSee('Soccer Management App');
    }

    /**
     * Test soccer ball API endpoint
     */
    public function test_soccer_ball_api(): void
    {
        $response = $this->get('/soccer/api/ball');
        
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Soccer Ball 3D Model',
            'file' => 'footballsoccer_ball.glb'
        ]);
    }

    /**
     * Test teams page loads successfully
     */
    public function test_teams_page_loads(): void
    {
        $response = $this->get('/soccer/teams');
        
        $response->assertStatus(200);
        $response->assertSee('Team Management');
    }

    /**
     * Test teams API endpoint
     */
    public function test_teams_api(): void
    {
        $response = $this->get('/soccer/api/teams');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'teams' => [
                '*' => [
                    'id',
                    'name',
                    'founded',
                    'players',
                    'country',
                    'stadium'
                ]
            ],
            'total_teams',
            'message'
        ]);
    }

    /**
     * Test players page loads successfully
     */
    public function test_players_page_loads(): void
    {
        $response = $this->get('/soccer/players');
        
        $response->assertStatus(200);
        $response->assertSee('Player Management');
    }

    /**
     * Test players API endpoint
     */
    public function test_players_api(): void
    {
        $response = $this->get('/soccer/api/players');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'players' => [
                '*' => [
                    'id',
                    'name',
                    'position',
                    'age',
                    'team',
                    'goals',
                    'nationality'
                ]
            ],
            'total_players',
            'message'
        ]);
    }

    /**
     * Test stats API endpoint
     */
    public function test_stats_api(): void
    {
        $response = $this->get('/soccer/api/stats');
        
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'statistics' => [
                'total_teams',
                'total_players',
                'matches_played',
                'goals_scored',
                'average_goals_per_match',
                'top_scorer',
                'most_successful_team'
            ],
            'last_updated',
            'message'
        ]);
    }

    /**
     * Test backward compatibility for old ball endpoint
     */
    public function test_backward_compatibility_ball_endpoint(): void
    {
        $response = $this->get('/soccer/ball');
        
        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Soccer Ball 3D Model',
            'file' => 'footballsoccer_ball.glb'
        ]);
    }
}