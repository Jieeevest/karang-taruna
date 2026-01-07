<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\FinancialTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FinancialTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = FinancialTransaction::with('user');

        // Filter by type
        if ($request->has('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        // Filter by category
        if ($request->has('category') && $request->category !== '') {
            $query->where('category', $request->category);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from !== '') {
            $query->whereDate('transaction_date', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to !== '') {
            $query->whereDate('transaction_date', '<=', $request->date_to);
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $transactions = $query->latest('transaction_date')->paginate(15);

        // Calculate summary
        $totalIncome = FinancialTransaction::where('type', 'income')->sum('amount');
        $totalExpense = FinancialTransaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        // Get unique categories for filter
        $categories = FinancialTransaction::select('category')->distinct()->pluck('category');

        return view('cms.financial_transactions.index', compact(
            'transactions', 
            'totalIncome', 
            'totalExpense', 
            'balance',
            'categories'
        ));
    }

    public function create()
    {
        return view('cms.financial_transactions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_date' => 'required|date',
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string',
            'notes' => 'nullable|string',
            'evidence_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        // Handle file upload
        if ($request->hasFile('evidence_file')) {
            $path = $request->file('evidence_file')->store('financial_evidence', 'public');
            $validated['evidence_file'] = $path;
        }

        FinancialTransaction::create($validated);

        return redirect()->route('cms.financial-transactions.index')
            ->with('success', 'Transaksi keuangan berhasil ditambahkan.');
    }

    public function show(FinancialTransaction $financialTransaction)
    {
        $financialTransaction->load('user');
        return view('cms.financial_transactions.show', compact('financialTransaction'));
    }

    public function edit(FinancialTransaction $financialTransaction)
    {
        return view('cms.financial_transactions.edit', compact('financialTransaction'));
    }

    public function update(Request $request, FinancialTransaction $financialTransaction)
    {
        $validated = $request->validate([
            'transaction_date' => 'required|date',
            'type' => 'required|in:income,expense',
            'category' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'description' => 'required|string',
            'notes' => 'nullable|string',
            'evidence_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('evidence_file')) {
            // Delete old file if exists
            if ($financialTransaction->evidence_file) {
                Storage::disk('public')->delete($financialTransaction->evidence_file);
            }
            
            $path = $request->file('evidence_file')->store('financial_evidence', 'public');
            $validated['evidence_file'] = $path;
        }

        $financialTransaction->update($validated);

        return redirect()->route('cms.financial-transactions.index')
            ->with('success', 'Transaksi keuangan berhasil diperbarui.');
    }

    public function destroy(FinancialTransaction $financialTransaction)
    {
        // Delete evidence file if exists
        if ($financialTransaction->evidence_file) {
            Storage::disk('public')->delete($financialTransaction->evidence_file);
        }

        $financialTransaction->delete();

        return redirect()->route('cms.financial-transactions.index')
            ->with('success', 'Transaksi keuangan berhasil dihapus.');
    }
}
