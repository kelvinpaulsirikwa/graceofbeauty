<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display the contact us page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('websitepages.contactus.contactus');
    }

    /**
     * Store a consultation request.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'services' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        Consultation::create($validated);

        return redirect()->route('contact')
            ->with('success', 'Thank you! Your consultation request has been submitted. We will get back to you soon.');
    }
}
