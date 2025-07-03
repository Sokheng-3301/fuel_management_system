<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Exports\CustomerExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all customers from the database
        $data['customers'] = Customer::with('user')->orderBy('id', 'desc')->get();
        // Return the customers view with the customers data
        return view('backend.customer.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['update'] = false; // Set update to false for create view
        return view('backend.customer.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'fullname_kh' => 'required|string|max:255',
            'fullname_en' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'other' => 'nullable|string|max:500',
        ]);

        // Create a new customer record
        Customer::create([
            'fullname_kh' => $request->fullname_kh,
            'fullname_en' => $request->fullname_en,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'note' => $request->note,
            'created_by' => @Auth::user()->id, // Assuming you have an authenticated user
            'customer_code' => 'CUST-' . rand(1000, 99999), // Generate a unique customer code
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', __('Customer created successfully.'));
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
        // Find the customer by ID
        $data['item'] = Customer::findOrFail($id);
        $data['update'] = true; // Set update to true for edit view

        // Return the edit form view with the customer data
        return view('backend.customer.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'fullname_kh' => 'required|string|max:255',
            'fullname_en' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:500',
            'other' => 'nullable|string|max:500',
        ]);

        // Find the customer by ID and update it
        $customer = Customer::findOrFail($id);
        $customer->update([
            'fullname_kh' => $request->fullname_kh,
            'fullname_en' => $request->fullname_en,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'note' => $request->note,
            'updated_by' => @Auth::user()->id, // Assuming you have an authenticated user
        ]);

        // Redirect back with success message
        return redirect()->route('customer.index')->with('success', __('Customer updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
     public function destroy(string $id)
    {
        $customer = Customer::find($id);

        if ($customer) {
            // Check if the Customer is currently marked as deleted
            if ($customer->delete_status == 1) {
                // Mark the Customer as deleted
                $customer->update([
                    'delete_status' => 0, // Set delete status to 0 (deleted)
                    'deleted_by' => auth()->user()->id, // Assuming the user is authenticated
                    'deleted_date' => now(), // Set the deleted date to now
                ]);
                return response()->json(['message' => __('Customer moved to trash successfully.')]);
            } else {
                // Restore the Customer
                $customer->update([
                    'delete_status' => 1 // Set delete status to 1 (restored)
                ]);
                return response()->json(['message' => __('Customer restored successfully.')]);
            }
        } else {
            // If the Customer does not exist, return an error message
            return response()->json(['error' => __('Customer not found.')], 404);
        }
    }

    public function pdf()
    {
         $data['customers'] = Customer::with('user')->orderBy('id', 'desc')->get();
        $html = view('backend.pdf.customer', $data)->render();
        PdfKh::loadHtml($html)->addMPdfConfig([
            'mode' => 'utf-8',
            'format' => 'A4-P',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'font_size' => 11,
            'default_font' => 'khmeros',
            'default_font_size' => 11,
            'default_font_family' => 'khmeros',
        ])->download('customers-'.now()->format('d-m-Y__H:i:s').'.pdf');
    }

    public function exportExcel()
    {
        // return Excel::download(new FuelTypePriceExport, 'invoices.xlsx');
        $filename = 'customers-' . now()->format('d-m-Y__H-i-s') . '.xlsx';
        return Excel::download(new CustomerExport, $filename);
    }
}
