<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\LeadershipTeam;
use App\Models\UserFeedback;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display the services page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $services = Service::with('serviceImages.creator')->orderBy('order')->get();
        $leadershipTeams = LeadershipTeam::latest()->get();
        
        // Fetch 6 random user feedbacks (only those with images)
        $userFeedbacks = UserFeedback::whereNotNull('image')
            ->where('image', '!=', '')
            ->inRandomOrder()
            ->take(6)
            ->get();
        
        return view('websitepages.services.index', compact('services', 'leadershipTeams', 'userFeedbacks'));
    }

    /**
     * Display a specific service with all its images.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id, Request $request)
    {
        $service = Service::with('serviceImages.creator')->findOrFail($id);
        
        // Paginate service images (6 per page)
        $perPage = 6;
        $currentPage = $request->get('page', 1);
        $images = $service->serviceImages()->with('creator')->paginate($perPage, ['*'], 'page', $currentPage);
        
        return view('websitepages.services.show', compact('service', 'images'));
    }
}

