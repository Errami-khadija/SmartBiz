<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use Carbon\Carbon;

class ExpenseController extends Controller
{
   public function index()
    {
         $userId = auth()->id();

    $expenses = Expense::where('user_id', $userId)
        ->latest()
        ->get();

    // Dates
    $now = Carbon::now();

    $thisMonth = Expense::where('user_id', $userId)
        ->whereMonth('date', $now->month)
        ->whereYear('date', $now->year)
        ->sum('amount');

    $lastMonth = Expense::where('user_id', $userId)
        ->whereMonth('date', $now->copy()->subMonth()->month)
        ->whereYear('date', $now->copy()->subMonth()->year)
        ->sum('amount');

    $thisYear = Expense::where('user_id', $userId)
        ->whereYear('date', $now->year)
        ->sum('amount');

    $average = Expense::where('user_id', $userId)
        ->avg('amount');

    return view('expenses.index', compact(
        'expenses',
        'thisMonth',
        'lastMonth',
        'thisYear',
        'average'
    ));
    }

    public function create()
    {
        return view('expenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'item' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        Expense::create([
            'user_id' => auth()->id(),
            'category' => $request->category,
            'item' => $request->item,
            'amount' => $request->amount,
            'date' => $request->date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('expenses.index')
            ->with('success', 'Expense added successfully');
    }

    public function show(Expense $expense)
    {
        abort_if($expense->user_id !== auth()->id(), 403);

        return view('expenses.show', compact('expense'));
    }

    public function destroy(Expense $expense)
    {
        abort_if($expense->user_id !== auth()->id(), 403);

        $expense->delete();

        return redirect()->route('expenses.index')
            ->with('success', 'Expense deleted successfully');
    }
}
