<?php

namespace App\Http\Controllers;

use App\Models\Projects;
use App\Models\Skill;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $skills=Skill::all();
        $projects=Projects::all();
        return view('welcome',compact('skills','projects'));
    }
}
