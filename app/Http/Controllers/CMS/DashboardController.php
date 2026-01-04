<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User, ActivityPlan, ActivityRealization, Content, Documentation, Category};

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

        // Chart data - Monthly activities for last 6 months
        $monthlyActivities = [];
        $monthLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthLabels[] = $date->format('M Y');
            $monthlyActivities[] = ActivityPlan::whereYear('planned_date', $date->year)
                ->whereMonth('planned_date', $date->month)
                ->count();
        }

        // Category distribution
        $categories = Category::withCount('activityPlans')->get();
        $categoryLabels = $categories->pluck('name')->toArray();
        $categoryData = $categories->pluck('activity_plans_count')->toArray();

        return view('cms.dashboard', compact(
            'stats',
            'recentActivities',
            'recentContents',
            'monthlyActivities',
            'monthLabels',
            'categoryLabels',
            'categoryData'
        ));
    }
}
