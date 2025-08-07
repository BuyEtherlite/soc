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
            'description' => 'A 3D model of a soccer ball available in this application'
        ]);
    }
}
