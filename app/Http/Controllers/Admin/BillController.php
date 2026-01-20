<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\CommonServices;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Bill;
use App\Models\CarCategory;

class BillController extends Controller
{
    public function __construct(public CommonServices $commonServices) {}
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Base query with eager loaded category and newest first
        $query = Bill::with('category')->orderBy('id', 'DESC');

        // If search term provided, filter by recipient name, billNo or vehicleNumber
        if ($request->has('search') && strlen(trim($request->search)) > 0) {
            $term = trim($request->search);
            $query->where(function ($q) use ($term) {
                $q->where('recipient_name', 'like', "%{$term}%")
                    ->orWhere('billNo', 'like', "%{$term}%")
                    ->orWhere('vehicleNumber', 'like', "%{$term}%");
            });
        }

        // If fromLocation provided, filter bills whose stored route contains that pickup location.
        // Uses a simple text match against the JSON route column (case-insensitive).
        if ($request->filled('fromLocation')) {
            $from = trim($request->fromLocation);
            if ($from !== '') {
                $fromLower = mb_strtolower($from);
                $query->whereRaw('LOWER(route) LIKE ?', ["%{$fromLower}%"]);
            }
        }

        // Paginate and preserve search/fromLocation params in links
        $data['bill'] = $query->paginate(20)->appends($request->only('search', 'fromLocation'));

        return view('Admin.invoice.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['category'] = CarCategory::where('status', '1')->get();
        return view('Admin.invoice.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'recipient_name' => 'required|string',
            'grandTotal' => 'required|numeric',
        ]);

        // Generate sequential bill number
        $lastBill = Bill::orderBy('id', 'desc')->first();
        $nextNumber = $lastBill ? ($lastBill->id + 1) : 1;
        $billNo = 'Cabyatra' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);

        $bill = Bill::create([
            'billNo' => $billNo,
            'type' => $request->type ?? 0,
            'date' => $request->date,
            'route' => json_encode($request->route),
            'carCategoryId' => $request->carCategoryId,
            'vehicleNumber' => $request->vehicleNumber,
            'recipient_name' => $request->recipient_name,
            'recipient_gstNo' => $request->recipient_gstNo,
            'recipient_address' => $request->recipient_address ?? '',
            'goods_description' => $request->goods_description,
            'perKmCost' => $request->perKmCost ?? 0,
            'total_km' => $request->total_km ?? 0,
            'total_value' => $request->total_value ?? 0,
            'extraFairPerKm' => $request->extraFairPerKm ?? 0,
            'extraKm' => $request->extraKm ?? 0,
            'extraKmCost' => $request->extraKmCost ?? 0,
            'finalTotalKm' => $request->finalTotalKm ?? 0,
            'extraHourPerKm' => $request->extraHourPerKm ?? 0,
            'extraHour' => $request->extraHour ?? 0,
            'extraHourCharge' => $request->extraHourCharge ?? 0,
            'fuelCharge' => $request->fuelCharge ?? 0,
            'driverCharge' => $request->driverCharge ?? 0,
            'toll' => $request->toll ?? 0,
            'tax' => $request->tax ?? 0,
            'parking' => $request->parking ?? 0,
            'subTotal' => $request->subTotal ?? 0,
            'cgst' => $request->cgst ?? 0,
            'sgst' => $request->sgst ?? 0,
            'igst' => $request->igst ?? 0,
            'grandTotal' => $request->grandTotal,
        ]);

        return redirect()->route('billGenerate.index')->with('success', 'Bill Generated Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['bill'] = Bill::where('id', $id)->first();
        return view('Admin.invoice.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['bill'] = Bill::where('id', $id)->first();
        return view('Admin.invoice.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            'date' => 'required|date',
            'recipient_name' => 'required|string',
            'grandTotal' => 'required|numeric',
        ]);

        $bill = Bill::find($id);
        if (!$bill) {
            return redirect()->back()->with('error', 'Bill not found!');
        }

        $bill->update([
            'type' => $request->type,
            'date' => $request->date,
            'route' => json_encode($request->route),
            'carCategoryId' => $request->carCategoryId,
            'vehicleNumber' => $request->vehicleNumber,
            'recipient_name' => $request->recipient_name,
            'recipient_gstNo' => $request->recipient_gstNo,
            'recipient_address' => $request->recipient_address ?? '',
            'goods_description' => $request->goods_description,
            'perKmCost' => $request->perKmCost ?? 0,
            'total_km' => $request->total_km ?? 0,
            'total_value' => $request->total_value ?? 0,
            'extraFairPerKm' => $request->extraFairPerKm ?? 0,
            'extraKm' => $request->extraKm ?? 0,
            'extraKmCost' => $request->extraKmCost ?? 0,
            'finalTotalKm' => $request->finalTotalKm ?? 0,
            'extraHourPerKm' => $request->extraHourPerKm ?? 0,
            'extraHour' => $request->extraHour ?? 0,
            'extraHourCharge' => $request->extraHourCharge ?? 0,
            'fuelCharge' => $request->fuelCharge ?? 0,
            'driverCharge' => $request->driverCharge ?? 0,
            'toll' => $request->toll ?? 0,
            'tax' => $request->tax ?? 0,
            'parking' => $request->parking ?? 0,
            'subTotal' => $request->subTotal ?? 0,
            'cgst' => $request->cgst ?? 0,
            'sgst' => $request->sgst ?? 0,
            'igst' => $request->igst ?? 0,
            'grandTotal' => $request->grandTotal,
        ]);

        return redirect()->route('billGenerate.index')->with('success', 'Bill Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // public function download($id)
    // {
    //     $data['bill'] = Bill::with('category')->where('id', $id)->first();

    //     // if (!$data['bill']) {
    //     //     return redirect()->back()->with('error', 'Bill not found!');
    //     // }

    //     // Use your invoice view for PDF generation
    //     $pdf = Pdf::loadView('Admin.invoice.pdfData', compact('data'));

    //     return $pdf->download('invoice_' . ($data['bill']->billNo ?? $id) . '.pdf');
    // }
    public function download($id)
    {
        // Fetch the bill data
        $bill = Bill::with('category')->find($id);

        // Check if bill exists
        if (!$bill) {
            return redirect()->back()->with('error', 'Bill not found!');
        }

        // Load view and generate PDF
        $pdf = Pdf::loadView('Admin.invoice.pdfData', ['bill' => $bill]);

        // Return PDF download response
        return $pdf->download('invoice_' . ($bill->billNo ?? $bill->id) . '.pdf');
    }
}
