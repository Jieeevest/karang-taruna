<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\ActivityPlan;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityPlanController extends Controller
{
    public function index(Request $request)
    {
        $query = ActivityPlan::with(['user', 'category', 'approver']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%");
        }

        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $activityPlans = $query->latest()->paginate(10);

        return view('cms.activity_plans.index', compact('activityPlans'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('cms.activity_plans.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'objectives' => 'nullable|string',
            'planned_date' => 'required|date',
            'location' => 'required|string|max:255',
            'budget' => 'required|numeric|min:0',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'draft'; // Default status

        ActivityPlan::create($validated);

        return redirect()->route('cms.activity-plans.index')
            ->with('success', 'Rencana kegiatan berhasil dibuat.');
    }

    public function edit(ActivityPlan $activityPlan)
    {
        $categories = Category::all();
        return view('cms.activity_plans.edit', compact('activityPlan', 'categories'));
    }

    public function update(Request $request, ActivityPlan $activityPlan)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'objectives' => 'nullable|string',
            'planned_date' => 'required|date',
            'location' => 'required|string|max:255',
            'budget' => 'required|numeric|min:0',
            'status' => 'required|in:draft,pending,approved,rejected',
            'rejection_reason' => 'nullable|string|required_if:status,rejected',
        ]);

        // Handle approval logic
        if ($validated['status'] === 'approved' && $activityPlan->status !== 'approved') {
            $validated['approved_by'] = Auth::id();
            $validated['approved_at'] = now();
        }

        $activityPlan->update($validated);

        return redirect()->route('cms.activity-plans.index')
            ->with('success', 'Rencana kegiatan berhasil diperbarui.');
    }

    public function submitForReview(ActivityPlan $activityPlan)
    {
        // Only allow submission if status is draft
        if ($activityPlan->status !== 'draft') {
            return redirect()->route('cms.activity-plans.index')
                ->with('error', 'Hanya rencana kegiatan dengan status Draft yang dapat diajukan untuk review.');
        }

        $activityPlan->update(['status' => 'pending_review']);

        return redirect()->route('cms.activity-plans.index')
            ->with('success', 'Rencana kegiatan berhasil diajukan untuk review.');
    }

    public function approve(ActivityPlan $activityPlan)
    {
        // Validate only pending_review can be approved
        if ($activityPlan->status !== 'pending_review') {
            return redirect()->route('cms.activity-plans.index')
                ->with('error', 'Hanya rencana dengan status Menunggu Review yang dapat disetujui.');
        }
        
        // Update plan status
        $activityPlan->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);
        
        // Auto-create realization
        \App\Models\ActivityRealization::create([
            'activity_plan_id' => $activityPlan->id,
            'user_id' => $activityPlan->user_id,
            'actual_date' => $activityPlan->planned_date,
            'actual_location' => $activityPlan->location,
            'actual_budget' => $activityPlan->budget,
            'participants_count' => 0,
            'report' => 'Menunggu pelaksanaan kegiatan',
            'status' => 'sedang_berjalan',
        ]);
        
        return redirect()->route('cms.activity-plans.index')
            ->with('success', 'Rencana kegiatan berhasil disetujui dan realisasi telah dibuat.');
    }

    public function reject(Request $request, ActivityPlan $activityPlan)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);
        
        if ($activityPlan->status !== 'pending_review') {
            return redirect()->route('cms.activity-plans.index')
                ->with('error', 'Hanya rencana dengan status Menunggu Review yang dapat ditolak.');
        }
        
        $activityPlan->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
        ]);
        
        return redirect()->route('cms.activity-plans.index')
            ->with('success', 'Rencana kegiatan ditolak.');
    }

    public function destroy(ActivityPlan $activityPlan)
    {
        $activityPlan->delete();

        return redirect()->route('cms.activity-plans.index')
            ->with('success', 'Rencana kegiatan berhasil dihapus.');
    }
}
