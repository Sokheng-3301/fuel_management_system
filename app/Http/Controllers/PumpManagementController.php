<?php

namespace App\Http\Controllers;

use App\Exports\PumpManagementExport;
use App\Models\FuelType;
use Illuminate\Http\Request;
use App\Models\PumpManagement;
use Maatwebsite\Excel\Facades\Excel;
use KhmerPdf\LaravelKhPdf\Facades\PdfKh;

class PumpManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pumps'] = PumpManagement::with('fuelType', 'user')->orderBy('id', 'desc')->get();
        return view('backend.pump-management.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['update'] = false;
        $data['fuel_types'] = FuelType::where('visibility', 1)->orderBy('id', 'desc')->get();
        return view('backend.pump-management.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->input());
        $status = '';
        $request->validate([
            'pump_code' => 'required|string|unique:pump_managements,pump_code|max:255',
            'fuel_type_id' => 'required|string',
        ]);

        if ($request->has('status')) {
            $status = 1;
        } else {
            $status = 0;
        }

        $addPump = PumpManagement::create([
            'pump_code' => $request->pump_code,
            'fuel_type_id' => $request->fuel_type_id,
            'status' => $status,
            'created_by' => auth()->user()->id,
        ]);

        if ($addPump == true) {
            return redirect()->back()->with('success', __('Add pump management successfully.'));
        } else {
            return redirect()->back()->with('error', __('Failed to add pump management.'))->withInput();
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
        $data['item'] = PumpManagement::findOrFail($id);
        $data['update'] = true;
        $data['fuel_types'] = FuelType::where('visibility', 1)->orderBy('id', 'desc')->get();
        return view('backend.pump-management.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $checkItem = PumpManagement::findOrFail($id);
        $status = '';
        $request->validate([
            'pump_code' => 'required|string|max:255|unique:pump_managements,pump_code,' . $id,
            'fuel_type_id' => 'required|string',
        ]);

        if ($request->has('status')) {
            $status = 1;
        } else {
            $status = 0;
        }

        $addPump = $checkItem->update([
            'pump_code' => $request->pump_code,
            'fuel_type_id' => $request->fuel_type_id,
            'status' => $status,
            'updated_by' => auth()->user()->id,
        ]);

        if ($addPump == true) {
            return redirect()->route('pump.index')->with('success', __('Add pump management successfully.'));
        } else {
            return redirect()->back()->with('error', __('Failed to add pump management.'))->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Sale = PumpManagement::find($id);

        if ($Sale) {
            // Check if the Sale is currently marked as deleted
            if ($Sale->delete_status == 1) {
                // Mark the Sale as deleted
                $Sale->update([
                    'delete_status' => 0, // Set delete status to 0 (deleted)
                    'deleted_by' => auth()->user()->id, // Assuming the user is authenticated
                    'deleted_at' => now(), // Set the deleted date to now
                ]);
                return response()->json(['message' => __('Moved pump management to trash successfully.')]);
            } else {
                // Restore the Sale
                $Sale->update([
                    'delete_status' => 1 // Set delete status to 1 (restored)
                ]);
                return response()->json(['message' => __('Restored pump management successfully.')]);
            }
        } else {
            // If the Sale does not exist, return an error message
            return response()->json(['error' => __('Pump management not found.')], 404);
        }
    }


    public function pdf()
    {
        $data['pumps'] = PumpManagement::with('fuelType', 'user')->where('delete_status', 1)->orderBy('id', 'desc')->get();
        $html = view('backend.pdf.pumpManagement', $data)->render();
        PdfKh::loadHtml($html)->addMPdfConfig([
            'mode' => 'utf-8',
            'format' => 'A4-P',
            'margin_top' => 10,
            'margin_bottom' => 10,
            'font_size' => 11,
            'default_font' => 'khmeros',
            'default_font_size' => 11,
            'default_font_family' => 'khmeros',
        ])->download('pump-management-' . now()->format('d-m-Y__H:i:s') . '.pdf');
    }

    public function exportExcel()
    {
        // return Excel::download(new FuelTypePriceExport, 'invoices.xlsx');
        $filename = 'pump-management-' . now()->format('d-m-Y__H-i-s') . '.xlsx';
        return Excel::download(new PumpManagementExport, $filename);
    }
}
