<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'age'       => 'nullable|integer|min:1|max:120',
            'email'     => 'required|email|max:255',
            'phone'     => 'required|string|max:20',
            'location'  => 'nullable|string|max:255',
            'reason'    => 'required|string|max:100',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Your form has been submitted successfully!');
    }
}
