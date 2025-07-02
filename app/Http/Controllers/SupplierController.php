<?php

namespace App\Http\Controllers;

use App\Exports\SupplierExport;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all suppliers from the database
        $data['suppliers'] = Supplier::with('user')->orderBy('id', 'desc')->get();
        // Return the suppliers view with the suppliers data
        return view('backend.supplier.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['update'] = false; // Flag to indicate this is a create operation
        // Return the view for creating a new supplier
        return view('backend.supplier.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname_kh' => 'required|string|max:255',
            'fullname_en' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);
        // $data['supplier']
        // Create a new supplier instance
        $supplier = Supplier::create([
            'supplier_code' => 'SUP-' . time(), // Generate a unique supplier code
            'fullname_kh' => $request->input('fullname_kh'),
            'fullname_en' => $request->input('fullname_en'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'created_by' => auth()->user()->id, // Assuming the user is authenticated
        ]);

        if ($supplier) {
            // Redirect to the suppliers index with a success message
            return redirect()->back()->with('success', __('Supplier created successfully.'));
        } else {
            // Redirect back with an error message
            return redirect()->back()->with('error', __('Failed to create supplier.'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find the supplier by ID
        $data['item'] = Supplier::findOrFail($id);
        $data['update'] = true; // Flag to indicate this is an update operation
        // Return the view for editing the supplier
        return view('backend.supplier.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'fullname_kh' => 'required|string|max:255',
            'fullname_en' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        // Find the supplier by ID
        $supplier = Supplier::findOrFail($id);

        // Update the supplier details
        $supplier->update([
            'fullname_kh' => $request->input('fullname_kh'),
            'fullname_en' => $request->input('fullname_en'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'updated_by' => auth()->user()->id, // Assuming the user is authenticated
        ]);

        // Redirect to the suppliers index with a success message
        return redirect()->route('supplier.index')->with('success', __('Supplier updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);

        if ($supplier) {
            // Check if the supplier is currently marked as deleted
            if ($supplier->delete_status == 1) {
                // Mark the supplier as deleted
                $supplier->update([
                    'delete_status' => 0, // Set delete status to 0 (deleted)
                    'deleted_by' => auth()->user()->id, // Assuming the user is authenticated
                    'deleted_date' => now(), // Set the deleted date to now
                ]);
                return response()->json(['message' => __('Supplier moved to trash successfully.')]);
            } else {
                // Restore the supplier
                $supplier->update([
                    'delete_status' => 1 // Set delete status to 1 (restored)
                ]);
                return response()->json(['message' => __('Supplier restored successfully.')]);
            }
        } else {
            // If the supplier does not exist, return an error message
            return response()->json(['error' => __('Supplier not found.')], 404);
        }
    }

    public function pdf()
    {
        $data['suppliers'] = Supplier::with('user')->where('delete_status', 1)->orderBy('id', 'desc')->get();
        $html = view('backend.pdf.supplier', $data)->render();
        PdfKh::loadHtml($html)->addMPdfConfig([
            'mode' => 'utf-8',
            'format' => 'A4-P',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'font_size' => 11,
            'default_font' => 'khmeros',
            'default_font_size' => 11,
            'default_font_family' => 'khmeros',
        ])->download('suppliers-'.now()->format('d-m-Y__H:i:s').'.pdf');
    }

    public function exportExcel()
    {
        // return Excel::download(new FuelTypePriceExport, 'invoices.xlsx');
        $filename = 'suppliers-' . now()->format('d-m-Y__H-i-s') . '.xlsx';
        return Excel::download(new SupplierExport, $filename);
    }
}
