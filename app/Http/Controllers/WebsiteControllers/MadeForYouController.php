<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MadeForYouController extends Controller
{
    /**
     * Display the made for you page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('websitepages.madeforyou.madeforyou');
    }
}

