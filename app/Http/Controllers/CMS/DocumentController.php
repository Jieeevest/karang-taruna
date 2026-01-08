<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Document::with('user');

        // Search
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('file_name', 'like', "%{$search}%");
            });
        }

        $documents = $query->latest()->paginate(15);

        // Calculate summary
        $totalDocuments = Document::count();
        $totalSize = Document::sum('file_size');

        return view('cms.documents.index', compact('documents', 'totalDocuments', 'totalSize'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cms.documents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar|max:10240', // 10MB
        ]);

        $validated['user_id'] = Auth::id();

        // Handle file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            // Store file
            $path = $file->store('documents', 'public');
            
            $validated['file_name'] = $file->getClientOriginalName();
            $validated['file_path'] = $path;
            $validated['file_size'] = $file->getSize();
            $validated['file_type'] = $file->getMimeType();
        }

        Document::create($validated);

        return redirect()->route('cms.documents.index')
            ->with('success', 'Dokumen berhasil diupload.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        $document->load('user');
        return view('cms.documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        // Authorization - only owner or ketua can edit
        if (Auth::id() !== $document->user_id && !Auth::user()->isKetua()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit dokumen ini.');
        }

        return view('cms.documents.edit', compact('document'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Document $document)
    {
        // Authorization - only owner or ketua can update
        if (Auth::id() !== $document->user_id && !Auth::user()->isKetua()) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit dokumen ini.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,zip,rar|max:10240', // 10MB
        ]);

        // Handle file replacement
        if ($request->hasFile('file')) {
            // Delete old file
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }
            
            $file = $request->file('file');
            $path = $file->store('documents', 'public');
            
            $validated['file_name'] = $file->getClientOriginalName();
            $validated['file_path'] = $path;
            $validated['file_size'] = $file->getSize();
            $validated['file_type'] = $file->getMimeType();
        }

        $document->update($validated);

        return redirect()->route('cms.documents.index')
            ->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        // Authorization - only owner or ketua can delete
        if (Auth::id() !== $document->user_id && !Auth::user()->isKetua()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus dokumen ini.');
        }

        // Delete file from storage
        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('cms.documents.index')
            ->with('success', 'Dokumen berhasil dihapus.');
    }

    /**
     * Download the specified document.
     */
    public function download(Document $document)
    {
        if (!Storage::disk('public')->exists($document->file_path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::disk('public')->download($document->file_path, $document->file_name);
    }
}
