<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\LeadershipTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LeadershipTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leadershipTeams = LeadershipTeam::with('creator')->latest()->paginate(10);
        return view('adminpages.leadershipteam.index', compact('leadershipTeams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminpages.leadershipteam.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'rank' => ['required', 'string', 'max:255'],
            'phonenumber' => ['nullable', 'string', 'max:255'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'gmail' => ['nullable', 'email', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:150'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('leadership_teams', 'public');
        }

        LeadershipTeam::create([
            'name' => $validated['name'],
            'rank' => $validated['rank'],
            'phonenumber' => $validated['phonenumber'] ?? null,
            'facebook' => $validated['facebook'] ?? null,
            'gmail' => $validated['gmail'] ?? null,
            'instagram' => $validated['instagram'] ?? null,
            'description' => $validated['description'],
            'image' => $imagePath,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.leadership_teams.index')
            ->with('success', 'Leadership team member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $leadershipTeam = LeadershipTeam::with('creator')->findOrFail($id);
        return view('adminpages.leadershipteam.show', compact('leadershipTeam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $leadershipTeam = LeadershipTeam::findOrFail($id);
        return view('adminpages.leadershipteam.edit', compact('leadershipTeam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $leadershipTeam = LeadershipTeam::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'rank' => ['required', 'string', 'max:255'],
            'phonenumber' => ['nullable', 'string', 'max:255'],
            'facebook' => ['nullable', 'string', 'max:255'],
            'gmail' => ['nullable', 'email', 'max:255'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:150'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $imagePath = $leadershipTeam->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($leadershipTeam->image && Storage::disk('public')->exists($leadershipTeam->image)) {
                Storage::disk('public')->delete($leadershipTeam->image);
            }
            $imagePath = $request->file('image')->store('leadership_teams', 'public');
        }

        $leadershipTeam->update([
            'name' => $validated['name'],
            'rank' => $validated['rank'],
            'phonenumber' => $validated['phonenumber'] ?? null,
            'facebook' => $validated['facebook'] ?? null,
            'gmail' => $validated['gmail'] ?? null,
            'instagram' => $validated['instagram'] ?? null,
            'description' => $validated['description'],
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.leadership_teams.index')
            ->with('success', 'Leadership team member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $leadershipTeam = LeadershipTeam::findOrFail($id);
        
        // Delete image if exists
        if ($leadershipTeam->image && Storage::disk('public')->exists($leadershipTeam->image)) {
            Storage::disk('public')->delete($leadershipTeam->image);
        }
        
        $leadershipTeam->delete();

        return redirect()->route('admin.leadership_teams.index')
            ->with('success', 'Leadership team member deleted successfully.');
    }
}

