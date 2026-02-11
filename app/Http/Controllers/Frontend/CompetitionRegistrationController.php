<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompetitionRegistrationController extends Controller
{
    public function create()
    {
        return view('frontend.competition.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'school_class' => 'required|string',
            'whatsapp' => 'required|string',
            'domicile_rt' => 'required|string',
            'competition_type' => 'required|string',
            'payment_method' => 'required|string',
            'payment_proof' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('payment_proofs', 'public');
            $validated['payment_proof'] = $path;
        }

        \App\Models\CompetitionRegistration::create($validated);

        return redirect()->route('competition.register')->with('success', 'Pendaftaran berhasil! Panitia akan segera menghubungi Anda.');
    }
}
