<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\FuelType;
use Illuminate\Http\Request;
use App\Models\SaleManagement;
use Illuminate\Support\Carbon;

class SaleManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SaleManagement::with(['customer', 'fuelType', 'user'])
            ->orderBy('id', 'desc');
        $data['isSearch'] = false;
        if (!empty($request->query())) {
            $data['isSearch'] = true;
            $year = $request->query('year');
            $start_date =  '';
            $end_date =  '';
            if ($request->query('start-date') != '') {
                $start_date = Carbon::parse($request->query('start-date'))->format('Y-m-d');
            }

            if ($request->query('end-date') != '') {
                $end_date = Carbon::parse($request->query('end-date'))->format('Y-m-d');
            }


            if ($year == '' && $start_date == '' && $end_date == '') {
                $data['sales'] = $query->get();
            } elseif ($year != '') {
                // Year only
                $data['sales'] = $query->whereYear('sale_date', $year)->get();
            } elseif ($start_date != '' && empty($year) && empty($end_date)) {
                // Start date only
                $data['sales'] = $query->whereBetween('sale_date', [$start_date, now()->format('Y-m-d')])->get();
            } elseif ($start_date != '' && $end_date != '') {
                // Between date
                $data['sales'] = $query->whereBetween('sale_date', [$start_date, $end_date])->get();
            } else {
                // all
                $data['sales'] = $query->whereDate('created_at', today())->get();
            }
        } else {
            // all
            $data['sales'] = $query->whereDate('created_at', today())->get();
        }

        return view('backend.sale-management.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['update'] = false;
        $data['fuel_types'] = FuelType::where('visibility', 1)
            ->orderBy('id', 'desc')
            ->get();
        $data['customers'] = Customer::where('delete_status', 1)
            ->orderBy('id', 'desc')
            ->get();
        return view('backend.sale-management.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|string|max:255',
            'vichle_number' => 'required|string|max:255',
            'sale_date' => 'required|date',
            'fuel_type_id' => 'required|string',
            'quantity' => 'required|string|max:255',
            'unit_price' => 'required|string|max:255',
            'total_price' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'discount' => 'required|string|max:255',
            'note' => 'nullable|string|max:255',
        ]);

        if ($request->has('status')) {
            $status = $request->status;
        } else {
            $status = 0; // Default status
        }

        $sale = SaleManagement::create([
            'sale_code' => 'SM-' . rand(100, 99999), // Generate a random sale code
            'customer_id' => $request->customer_id,
            'fuel_type_id' => $request->fuel_type_id,
            'vichle_number' => $request->vichle_number,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total_price' => $request->total_price,
            'sale_date' => Carbon::parse($request->sale_date)->format('Y-m-d'),
            'note' => $request->note,
            'status' => $status,
            'payment_method' => $request->payment_method,
            'employee_id' => auth()->user()->id, // Assuming the employee is the logged-in user
            'discount' => $request->discount,
        ]);

        if ($sale) {
            return redirect()->back()
                ->with('success', __('Sale Management created successfully.'));
        } else {
            return redirect()->back()
                ->with('error', __('Failed to create Sale Management. Please try again.'))->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $getUrl = url()->previous();
        $queryString = parse_url($getUrl, PHP_URL_QUERY);
        $data['queryString'] = $queryString;
        $data['item'] = SaleManagement::with(['customer', 'fuelType', 'user'])->findOrFail($id);
        return view('backend.sale-management.about', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['update'] = true;
        $getUrl = url()->previous();
        $queryString = parse_url($getUrl, PHP_URL_QUERY);
        $data['queryString'] = $queryString;
        $data['item'] = SaleManagement::with(['customer', 'fuelType', 'user'])->findOrFail($id);
        $data['fuel_types'] = FuelType::where('visibility', 1)
            ->orderBy('id', 'desc')
            ->get();
        $data['customers'] = Customer::where('delete_status', 1)
            ->orderBy('id', 'desc')
            ->get();
        return view('backend.sale-management.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $saleData = SaleManagement::findOrFail($id);
        $queryString = $request->query_string;

        $request->validate([
            'customer_id' => 'required|string|max:255',
            'vichle_number' => 'required|string|max:255',
            'sale_date' => 'required|date',
            'fuel_type_id' => 'required|string',
            'quantity' => 'required|string|max:255',
            'unit_price' => 'required|string|max:255',
            'total_price' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'discount' => 'required|string|max:255',
            'note' => 'nullable|string|max:255',
        ]);

        if ($request->has('status')) {
            $status = $request->status;
        } else {
            $status = 0; // Default status
        }

        $sale = $saleData->update([
            'customer_id' => $request->customer_id,
            'fuel_type_id' => $request->fuel_type_id,
            'vichle_number' => $request->vichle_number,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'total_price' => $request->total_price,
            'sale_date' => Carbon::parse($request->sale_date)->format('Y-m-d'),
            'note' => $request->note,
            'status' => $status,
            'payment_method' => $request->payment_method,
            'employee_id' => auth()->user()->id, // Assuming the employee is the logged-in user
            'discount' => $request->discount,
            'updated_by' => auth()->user()->id
        ]);

        if ($sale) {
            return redirect()->route('sale.index', $queryString)
                ->with('success', __('Sale Management updated successfully.'));
        } else {
            return redirect()->back()
                ->with('error', __('Failed to update Sale Management. Please try again.'))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // make as completed

    public function complete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:sale_managements,id',
        ]);

        $sale = SaleManagement::findOrFail($request->id);
        $update = $sale->update([
            'status' => 1, // Assuming 1 means completed
            'updated_by' => auth()->user()->id, // Assuming the employee is the logged-in user
        ]);
        if ($update == true) {
            return response()->json([
                'status' => 'success',
                'message' => __('Sale Management make as completed successfully.'),
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => __('Failed to make as completed Sale Management.'),
            ]);
        }
    }

    public function invoice($id)
    {
        $item = SaleManagement::with(['customer', 'fuelType', 'user'])->findOrFail($id);
        return response()->json([
            'status' => true,
            'data' => $item,
        ]);
    }
}
