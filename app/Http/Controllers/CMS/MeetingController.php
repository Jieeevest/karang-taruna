<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MeetingController extends Controller
{
    public function index(Request $request)
    {
        $query = Meeting::with('user');

        // Filter by status
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter by date
        if ($request->has('date_from') && $request->date_from !== '') {
            $query->whereDate('meeting_date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to !== '') {
            $query->whereDate('meeting_date', '<=', $request->date_to);
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('agenda', 'like', "%{$search}%");
            });
        }

        $meetings = $query->latest('meeting_date')->paginate(15);

        return view('cms.meetings.index', compact('meetings'));
    }

    public function create()
    {
        return view('cms.meetings.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'meeting_date' => 'required|date',
            'meeting_time' => 'required',
            'location' => 'required|string|max:255',
            'agenda' => 'required|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:scheduled,completed,cancelled',
        ]);

        $validated['user_id'] = Auth::id();

        Meeting::create($validated);

        return redirect()->route('cms.meetings.index')
            ->with('success', 'Jadwal rapat berhasil ditambahkan.');
    }

    public function show(Meeting $meeting)
    {
        $meeting->load('user');
        return view('cms.meetings.show', compact('meeting'));
    }

    public function edit(Meeting $meeting)
    {
        return view('cms.meetings.edit', compact('meeting'));
    }

    public function update(Request $request, Meeting $meeting)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'meeting_date' => 'required|date',
            'meeting_time' => 'required',
            'location' => 'required|string|max:255',
            'agenda' => 'required|string',
            'notes' => 'nullable|string',
            'status' => 'required|in:scheduled,completed,cancelled',
        ]);

        $meeting->update($validated);

        return redirect()->route('cms.meetings.index')
            ->with('success', 'Jadwal rapat berhasil diperbarui.');
    }

    public function complete(Meeting $meeting)
    {
        if ($meeting->status === 'completed') {
            return redirect()->route('cms.meetings.index')
                ->with('warning', 'Rapat sudah selesai.');
        }

        $meeting->update(['status' => 'completed']);

        return redirect()->route('cms.meetings.index')
            ->with('success', 'Rapat ditandai sebagai selesai.');
    }

    public function destroy(Meeting $meeting)
    {
        $meeting->delete();

        return redirect()->route('cms.meetings.index')
            ->with('success', 'Jadwal rapat berhasil dihapus.');
    }
}
