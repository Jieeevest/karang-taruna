<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Content, ActivityPlan, OrganizationProfile};

class HomeController extends Controller
{
    public function index()
    {
        $latestNews = Content::where('status', 'published')
            ->where('type', 'news')
            ->with('category')
            ->latest('published_at')
            ->take(6)
            ->get();

        $upcomingActivities = ActivityPlan::where('status', 'approved')
            ->where('planned_date', '>=', now())
            ->with('category')
            ->orderBy('planned_date')
            ->take(4)
            ->get();

        $stats = [
            'total_members' => \App\Models\User::where('is_active', true)->count(),
            'total_activities' => ActivityPlan::where('status', 'approved')->count(),
            'total_documentation' => \App\Models\Documentation::count(),
        ];

        $organization = OrganizationProfile::first();

        return view('public.home', compact('latestNews', 'upcomingActivities', 'stats', 'organization'));
    }
}
