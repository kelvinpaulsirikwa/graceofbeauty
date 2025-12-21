<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\LeadershipTeam;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display the about us page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $leadershipTeams = LeadershipTeam::latest()->get();
        return view('websitepages.aboutus.aboutus', compact('leadershipTeams'));
    }
}

