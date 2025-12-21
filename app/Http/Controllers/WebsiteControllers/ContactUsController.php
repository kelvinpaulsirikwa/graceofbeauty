<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
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
}
