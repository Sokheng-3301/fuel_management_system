<?php

namespace App\Http\Controllers;

use App\Models\Fuel;
use App\Models\FuelType;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\error;

class FuelsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['activeMenu'] = 'fuelMange';
        $data['fuels'] = Fuel::with(['fuelType', 'supplier', 'user'])
            ->orderBy('id', 'desc')
            ->get();
        return view('backend.fuel.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['activeMenu'] = 'fuelCreate';
        $data['update'] = false;
        $data['fuelTypes'] = FuelType::where('visibility', 1)->orderBy('id', 'desc')->get();
        $data['suppliers'] = Supplier::where('delete_status', 1)->orderBy('id', 'desc')->get();
        return view('backend.fuel.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'fuel_type_id' => 'required|integer|exists:fuel_types,id',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'qty' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
        ]);

        $addFuel = Fuel::create([
            'fuel_type_id' => $request->fuel_type_id,
            'supplier_id' => $request->supplier_id,
            'qty' => $request->qty,
            'unit_price' => $request->unit_price,
            'total_price' => $request->total_price,
            'fuel_code' => 'FUEL-' . time() . '-' . rand(1000, 9999),
            'fuel_specification' => $request->fuel_specification,
            'note' => $request->note,
            'created_by' => @Auth::user()->id,
        ]);

        if ($addFuel) {
            return redirect()->back()->with('success', __('Add fuel instock successfully'));
        } else {
            return redirect()->back()->with('error', __('Add fuel instock failed'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fuel = Fuel::with(['fuelType', 'supplier', 'user'])->find($id);

        if (!$fuel) {
            return response()->json([
                'status' => false,
                'message' => __('Fuel not found'),
            ], 404);
        }

        return response()->json([
            'status' => true,
            'fuelCode' => $fuel->fuel_code,
            'fuelType' => $fuel->fuelType->fuel_type_kh . ' - ' . $fuel->fuelType->fuel_type_en,
            'supplier' => $fuel->supplier->fullname_kh . ' - ' . $fuel->supplier->fullname_en,
            'qty' => $fuel->qty . " " . __("L"),
            'unitPrice' => $fuel->unit_price,
            'totalPrice' => $fuel->total_price,
            'createdBy' => $fuel->user->fullname_kh . ' - ' . $fuel->user->fullname_en,
            'createdAt' => $fuel->created_at->format('d m Y h:i:s A'),
            'delete_status' => $fuel->delete_status,
            'deleted_date' => $fuel->deleted_date ? $fuel->deleted_date->format('d m Y h:i:s A') : null,
            'deletedBy' => $fuel->deletedBy ? $fuel->user->fullname_kh . ' - '. $fuel->user->fullname_en : null,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['activeMenu'] = 'fuelCreate';
        $data['update'] = true;
        $data['fuel'] = Fuel::with(['fuelType', 'supplier'])->findOrFail($id);

        $data['fuelTypes'] = FuelType::where('visibility', 1)->orderBy('id', 'desc')->get();
        $data['suppliers'] = Supplier::where('delete_status', 1)->orderBy('id', 'desc')->get();
        return view('backend.fuel.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'fuel_type_id' => 'required|integer|exists:fuel_types,id',
            'supplier_id' => 'required|integer|exists:suppliers,id',
            'qty' => 'required|numeric|min:0',
            'unit_price' => 'required|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
        ]);

        $fuel = Fuel::findOrFail($id);
        $fuel->update([
            'fuel_type_id' => $request->fuel_type_id,
            'supplier_id' => $request->supplier_id,
            'qty' => $request->qty,
            'unit_price' => $request->unit_price,
            'total_price' => $request->total_price,
            'fuel_specification' => $request->fuel_specification,
            'note' => $request->note,
            'updated_by' => @Auth::user()->id,
        ]);

        if ($fuel) {
            return redirect()->route('fuel.index')->with('success', __('Fuel updated successfully'));
        } else {
            return redirect()->back()->with('error', __('Fuel update failed'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fuel = Fuel::find($id);
        if ($fuel) {
            // Check if the fuel is currently marked as deleted
            if ($fuel->delete_status == 1) {
                // Mark the fuel as deleted
                $fuel->update([
                    'delete_status' => 0, // Set delete status to 0 (deleted)
                    'deleted_by' => auth()->user()->id, // Assuming the user is authenticated
                    'deleted_date' => now(), // Set the deleted date to now
                ]);
                return response()->json(['message' => __('Fuel moved to trash successfully.')]);
            } else {
                // Restore the fuel
                $fuel->update([
                    'delete_status' => 1 // Set delete status to 1 (restored)
                ]);
                return response()->json(['message' => __('Fuel restored successfully.')]);
            }
        } else {
            // If the fuel does not exist, return an error message
            return response()->json(['error' => __('Fuel not found.')], 404);
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
        ])->download('suppliers-' . now()->format('d-m-Y__H:i:s') . '.pdf');
    }

    public function exportExcel()
    {
        // return Excel::download(new FuelTypePriceExport, 'invoices.xlsx');
        $filename = 'suppliers-' . now()->format('d-m-Y__H-i-s') . '.xlsx';
        return Excel::download(new SupplierExport, $filename);
    }
}
