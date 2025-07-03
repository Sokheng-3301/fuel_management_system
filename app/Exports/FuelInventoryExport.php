<?php

namespace App\Exports;

use App\Models\Fuel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class FuelInventoryExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $fuel = Fuel::with(['fuelType', 'supplier', 'user'])
            ->where('delete_status', 1) // Only include active fuels
            ->orderBy('id', 'desc');
        return view('backend.excel.fuelInventory', [
            'fuels' => $fuel->get(),
        ]);
    }
}
