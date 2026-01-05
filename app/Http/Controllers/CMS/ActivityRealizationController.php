<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\ActivityRealization;
use App\Models\ActivityPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityRealizationController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityRealization::with(['activityPlan', 'user', 'verifier']);

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $realizations = $query->latest()->paginate(10);

        return view('cms.activity_realizations.index', compact('realizations'));
    }

    public function create()
    {
        // Only plans that are approved and don't have a realization yet (or allow multiple?)
        // Assuming 1 realization per plan for now
        $plans = ActivityPlan::where('status', 'approved')
            ->doesntHave('realizations')
            ->get();
            
        return view('cms.activity_realizations.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'activity_plan_id' => 'required|exists:activity_plans,id|unique:activity_realizations,activity_plan_id',
            'actual_date' => 'required|date',
            'actual_location' => 'nullable|string|max:255',
            'participants_count' => 'required|integer|min:0',
            'actual_budget' => 'nullable|numeric|min:0',
            'report' => 'required|string',
            'achievements' => 'nullable|string',
            'obstacles' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'sedang_berjalan';

        ActivityRealization::create($validated);

        return redirect()->route('cms.activity-realizations.index')
            ->with('success', 'Laporan realisasi kegiatan berhasil dibuat.');
    }

    public function edit(ActivityRealization $activityRealization)
    {
        $activityRealization->load('documentation');
        return view('cms.activity_realizations.edit', compact('activityRealization'));
    }

    public function update(Request $request, ActivityRealization $activityRealization)
    {
        $validated = $request->validate([
            'actual_date' => 'required|date',
            'actual_location' => 'nullable|string|max:255',
            'participants_count' => 'required|integer|min:0',
            'actual_budget' => 'nullable|numeric|min:0',
            'report' => 'required|string',
            'achievements' => 'nullable|string',
            'obstacles' => 'nullable|string',
            'status' => 'required|in:sedang_berjalan,batal,final',
            'evidence.*' => 'nullable|image|max:5120', // 5MB max per image
        ]);

        if ($validated['status'] === 'final' && $activityRealization->status !== 'final') {
            $validated['verified_by'] = Auth::id();
            $validated['verified_at'] = now();
        }

        $activityRealization->update($validated);

        // Handle evidence upload
        if ($request->hasFile('evidence')) {
            foreach ($request->file('evidence') as $file) {
                $path = $file->store('documentation/realizations', 'public');
                
                \App\Models\Documentation::create([
                    'user_id' => Auth::id(),
                    'activity_realization_id' => $activityRealization->id,
                    'category_id' => $activityRealization->activityPlan->category_id,
                    'title' => $activityRealization->activityPlan->title . ' - ' . now()->format('d M Y H:i'),
                    'description' => 'Dokumentasi ' . $activityRealization->activityPlan->title,
                    'type' => 'photo',
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        }

        return redirect()->route('cms.activity-realizations.index')
            ->with('success', 'Laporan realisasi dan dokumentasi berhasil diperbarui.');
    }

    public function deleteEvidence(\App\Models\Documentation $documentation)
    {
        \Storage::disk('public')->delete($documentation->file_path);
        $documentation->delete();
        
        return response()->json(['success' => true]);
    }

    public function destroy(ActivityRealization $activityRealization)
    {
        $activityRealization->delete();

        return redirect()->route('cms.activity-realizations.index')
            ->with('success', 'Laporan realisasi kegiatan berhasil dihapus.');
    }
}
