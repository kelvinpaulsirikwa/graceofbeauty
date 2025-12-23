<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('creator')->latest()->paginate(10);
        return view('adminpages.payment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminpages.payment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('payments', 'public');
        }

        Payment::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment method created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::with('creator')->findOrFail($id);
        return view('adminpages.payment.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment = Payment::findOrFail($id);
        return view('adminpages.payment.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $payment = Payment::findOrFail($id);

        $imagePath = $payment->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($payment->image && Storage::disk('public')->exists($payment->image)) {
                Storage::disk('public')->delete($payment->image);
            }
            $imagePath = $request->file('image')->store('payments', 'public');
        }

        $payment->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? $payment->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment method updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        
        // Delete image if exists
        if ($payment->image && Storage::disk('public')->exists($payment->image)) {
            Storage::disk('public')->delete($payment->image);
        }

        $payment->delete();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Payment method deleted successfully.');
    }
}

