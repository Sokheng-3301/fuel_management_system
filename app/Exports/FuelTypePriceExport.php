<?php

namespace App\Exports;

use App\Models\FuelType;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FuelTypePriceExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $fuels = FuelType::with('user')
            ->orderBy('created_at', 'desc');
        return view('backend.excel.fuelPrice', [
            'fuels' => $fuels->get(),
        ]);
    }
}
