<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Content, ActivityPlan, OrganizationProfile, Documentation};

class PublicController extends Controller
{
    public function about()
    {
        $organization = OrganizationProfile::first();
        
        return view('public.about', compact('organization'));
    }

    public function activities(Request $request)
    {
        $query = ActivityPlan::where('status', 'approved')
            ->with('category');

        // Filter by status (upcoming/past)
        if ($request->has('filter')) {
            if ($request->filter === 'upcoming') {
                $query->where('planned_date', '>=', now());
            } elseif ($request->filter === 'past') {
                $query->where('planned_date', '<', now());
            }
        }

        $activities = $query->orderBy('planned_date', 'desc')->paginate(12);

        return view('public.activities', compact('activities'));
    }

    public function activityDetail($slug)
    {
        $activity = ActivityPlan::where('slug', $slug)
            ->where('status', 'approved')
            ->with('category')
            ->firstOrFail();

        return view('public.activity-detail', compact('activity'));
    }

    public function news(Request $request)
    {
        $query = Content::where('status', 'published')
            ->where('type', 'news')
            ->with('category');

        // Filter by category
        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $news = $query->latest('published_at')->paginate(12);

        return view('public.news', compact('news'));
    }

    public function newsDetail($slug)
    {
        $news = Content::where('slug', $slug)
            ->where('status', 'published')
            ->where('type', 'news')
            ->with('category')
            ->firstOrFail();

        // Get related news
        $relatedNews = Content::where('status', 'published')
            ->where('type', 'news')
            ->where('id', '!=', $news->id)
            ->when($news->category_id, function($query) use ($news) {
                return $query->where('category_id', $news->category_id);
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.news-detail', compact('news', 'relatedNews'));
    }

    public function documentation(Request $request)
    {
        $query = Documentation::query()->with('activityRealization');

        // Filter by activity
        if ($request->has('activity')) {
            $query->where('activity_realization_id', $request->activity);
        }

        $documentation = $query->latest('created_at')->paginate(24);

        return view('public.documentation', compact('documentation'));
    }

    public function getActivitiesByYear(Request $request)
    {
        $year = $request->query('year', date('Y'));
        
        $activities = ActivityPlan::where('status', 'approved')
            ->whereYear('planned_date', $year)
            ->with('category')
            ->orderBy('planned_date', 'desc')
            ->get()
            ->map(function($activity) {
                return [
                    'id' => $activity->id,
                    'title' => $activity->title,
                    'description' => $activity->description ?? 'Kegiatan ' . $activity->title,
                    'date' => $activity->planned_date ? $activity->planned_date->format('d M Y') : '-',
                    'category' => $activity->category ? $activity->category->name : null,
                    'image' => $activity->image ? asset('storage/' . $activity->image) : null,
                    'link' => url('/activities/' . $activity->slug),
                ];
            });

        return response()->json([
            'year' => $year,
            'activities' => $activities
        ]);
    }
}
