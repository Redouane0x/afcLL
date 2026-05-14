<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    private $teams = [
        ['name' => 'Séniors', 'slug' => 'seniors', 'age' => '20-35 ans'],
        ['name' => 'Vétérans', 'slug' => 'veterans', 'age' => '+35 ans'],
        ['name' => 'U18', 'slug' => 'u18', 'age' => '16-18 ans'],
        ['name' => 'U14', 'slug' => 'u14', 'age' => '13-14 ans'],
        ['name' => 'U13', 'slug' => 'u13', 'age' => '12-13 ans'],
        ['name' => 'U12', 'slug' => 'u12', 'age' => '11-12 ans'],
        ['name' => 'U11', 'slug' => 'u11', 'age' => '10-11 ans'],
        ['name' => 'U10', 'slug' => 'u10', 'age' => '9-10 ans'],
        ['name' => 'U9', 'slug' => 'u9', 'age' => '8-9 ans'],
        ['name' => 'U8', 'slug' => 'u8', 'age' => '7-8 ans'],
        ['name' => 'U7', 'slug' => 'u7', 'age' => '6-7 ans'],
        ['name' => 'U6', 'slug' => 'u6', 'age' => '5-6 ans'],
        ['name' => 'Baby', 'slug' => 'baby', 'age' => '3-5 ans'],
    ];

    public function index()
    {
        return view('pages.teams.index', [
            'teams' => $this->teams
        ]);
    }

    public function show($slug)
    {
        $team = collect($this->teams)->firstWhere('slug', $slug);

        if (!$team) abort(404);

        return view('pages.teams.show', [
            'team' => $team
        ]);
    }
}
