<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\CompetitionRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompetitionRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registrations = CompetitionRegistration::latest()->paginate(10);
        return view('cms.competition-registrations.index', compact('registrations'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompetitionRegistration  $competitionRegistration
     * @return \Illuminate\Http\Response
     */
    public function show(CompetitionRegistration $competitionRegistration)
    {
        return view('cms.competition-registrations.show', compact('competitionRegistration'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompetitionRegistration  $competitionRegistration
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompetitionRegistration $competitionRegistration)
    {
        if ($competitionRegistration->payment_proof) {
            Storage::disk('public')->delete($competitionRegistration->payment_proof);
        }
        
        $competitionRegistration->delete();
        
        return redirect()->route('cms.competition-registrations.index')
            ->with('success', 'Pendaftaran berhasil dihapus.');
    }
}
