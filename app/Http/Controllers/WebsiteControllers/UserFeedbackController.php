<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Service;
use App\Models\UserFeedback;
use Illuminate\Http\Request;

class UserFeedbackController extends Controller
{
    /**
     * Display a specific user feedback story.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function showStory($id)
    {
        $feedback = UserFeedback::findOrFail($id);
        
        $products = collect();
        $services = collect();
        
        if ($feedback->product_used && is_array($feedback->product_used)) {
            $products = Product::whereIn('product_id', $feedback->product_used)
                ->with(['productImages', 'brand', 'category'])
                ->get();
        }
        
        if ($feedback->service_used && is_array($feedback->service_used)) {
            $services = Service::whereIn('service_id', $feedback->service_used)
                ->with(['serviceImages'])
                ->get();
        }
        
        return view('websitepages.userfeedback.userstory', compact('feedback', 'products', 'services'));
    }
}

