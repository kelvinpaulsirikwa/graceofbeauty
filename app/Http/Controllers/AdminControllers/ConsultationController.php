<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultations = Consultation::latest()->paginate(15);
        $unreadCount = Consultation::where('read', false)->count();
        
        return view('adminpages.consultation.index', compact('consultations', 'unreadCount'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $consultation = Consultation::findOrFail($id);
        
        // Mark as read
        if (!$consultation->read) {
            $consultation->update(['read' => true]);
        }
        
        return view('adminpages.consultation.show', compact('consultation'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->delete();
        
        return redirect()->route('admin.consultations.index')
            ->with('success', 'Consultation deleted successfully.');
    }

    /**
     * Mark consultation as read/unread
     */
    public function toggleRead($id)
    {
        $consultation = Consultation::findOrFail($id);
        $consultation->update(['read' => !$consultation->read]);
        
        return redirect()->back()
            ->with('success', 'Consultation status updated.');
    }
}
