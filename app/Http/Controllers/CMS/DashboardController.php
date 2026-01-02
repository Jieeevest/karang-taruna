<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, ActivityPlan, ActivityRealization, Content, Documentation};

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'total_users' => User::where('is_active', true)->count(),
            'total_activities' => ActivityPlan::count(),
            'total_contents' => Content::where('status', 'published')->count(),
            'total_documentation' => Documentation::count(),
        ];

        // Get recent activities based on role
        $recentActivities = ActivityPlan::with(['user', 'category'])
            ->when($user->isAnggota(), function($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
            ->latest()
            ->take(5)
            ->get();

        // Get recent contents
        $recentContents = Content::with(['user', 'category'])
            ->latest()
            ->take(5)
            ->get();

        return view('cms.dashboard', compact('stats', 'recentActivities', 'recentContents'));
    }
}
