<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Client;
use Barryvdh\DomPDF\Facade\Pdf;



class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $invoices = Invoice::where('user_id', auth()->id())->get();

    $paidCount    = $invoices->where('status', 'Paid')->count();
    $pendingCount = $invoices->where('status', 'Pending')->count();
    $overdueCount = $invoices->where('status', 'Overdue')->count();

    $paidTotal    = $invoices->where('status', 'Paid')->sum('amount');
    $pendingTotal = $invoices->where('status', 'Pending')->sum('amount');
    $overdueTotal = $invoices->where('status', 'Overdue')->sum('amount');

    return view('invoices.index', compact(
        'invoices',
        'paidCount', 'pendingCount', 'overdueCount',
        'paidTotal', 'pendingTotal', 'overdueTotal'
    ));
}



    /**
     * Show the form for creating a new resource.
     */
   public function create()
    {
        $clients = Client::where('user_id', auth()->id())
            ->orderBy('name')
            ->get();

        return view('invoices.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'client_id' => 'required|exists:clients,id',
        'amount' => 'required|numeric',
        'status' => 'required',
        'invoice_date' => 'required|date',
    ]);

    // Generate invoice_id like INV-2024-001
    $lastInvoice = Invoice::latest()->first();
    $nextId = $lastInvoice ? $lastInvoice->id + 1 : 1;
    $invoiceId = 'INV-' . date('Y') . '-' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

    Invoice::create([
        'user_id' => auth()->id(),
       'client_id' => $request->client_id,
        'amount' => $request->amount,
        'status' => $request->status,
        'invoice_id' => $invoiceId,
        'invoice_date' => $request->invoice_date,
       
    ]);

    return redirect()->route('invoices.index');
}

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    public function download(Invoice $invoice)
{
    // Security: only owner can download
    abort_if($invoice->user_id !== auth()->id(), 403);

    $pdf = Pdf::loadView('invoices.pdf', [
        'invoice' => $invoice
    ]);

    $fileName = $invoice->invoice_id . '.pdf';

    return $pdf->download($fileName);
}


    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()
    ->route('invoices.index')
    ->with('success', 'Invoice deleted successfully.');

    }
}
