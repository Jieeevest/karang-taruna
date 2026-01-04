<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Documentation;
use App\Models\Category;
use App\Models\ActivityRealization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentationController extends Controller
{
    public function index(Request $request)
    {
        $query = Documentation::with(['user', 'category', 'activityRealization']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%");
        }

        if ($request->has('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        $documents = $query->latest()->paginate(12); // Grid layout uses 12 items

        return view('cms.documentation.index', compact('documents'));
    }

    public function create()
    {
        $categories = Category::all();
        $realizations = ActivityRealization::with('activityPlan')->latest()->get();
        return view('cms.documentation.create', compact('categories', 'realizations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'activity_realization_id' => 'nullable|exists:activity_realizations,id',
            'file' => 'required|file|max:10240', // Max 10MB
            'type' => 'required|in:photo,video,document',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('public/documentation', $fileName);

            $validated['file_path'] = 'documentation/' . $fileName; // Store relative path for Storage::url
            $validated['file_name'] = $fileName;
            $validated['file_type'] = $file->getMimeType();
            $validated['file_size'] = $file->getSize();
            $validated['user_id'] = Auth::id();

            Documentation::create($validated);

            return redirect()->route('cms.documentation.index')
                ->with('success', 'Dokumentasi berhasil diunggah.');
        }

        return back()->with('error', 'Gagal mengunggah file.');
    }

    public function edit(Documentation $documentation)
    {
        $categories = Category::all();
        $realizations = ActivityRealization::with('activityPlan')->latest()->get();
        return view('cms.documentation.edit', compact('documentation', 'categories', 'realizations'));
    }

    public function update(Request $request, Documentation $documentation)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
            'activity_realization_id' => 'nullable|exists:activity_realizations,id',
            'type' => 'required|in:photo,video,document',
        ]);

        // File update logic if needed in future (currently just metadata)
        
        $documentation->update($validated);

        return redirect()->route('cms.documentation.index')
            ->with('success', 'Informasi dokumentasi berhasil diperbarui.');
    }

    public function destroy(Documentation $documentation)
    {
        if (Storage::exists('public/' . $documentation->file_path)) {
            Storage::delete('public/' . $documentation->file_path);
        }

        $documentation->delete();

        return redirect()->route('cms.documentation.index')
            ->with('success', 'File dokumentasi berhasil dihapus.');
    }
}
