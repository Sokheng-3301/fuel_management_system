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
        //
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
