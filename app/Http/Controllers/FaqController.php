<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faqs = Faq::orderBy('created_at', 'desc')->get();
        return view('admin.faqs.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = 'active'; // Default status for new FAQs
        return view('admin.faqs.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'status' => $request->status,
        ]);

        return redirect()->route('faqs.index')->with('success', 'FAQ created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faqs.view', compact('faq'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faq = Faq::findOrFail($id);
        return view('admin.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $faq = Faq::findOrFail($id);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'status' => $request->status,
        ]);

        return redirect()->route('faqs.index')->with('success', 'FAQ updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();

        return redirect()->route('faqs.index')->with('success', 'FAQ deleted successfully');
    }
}
