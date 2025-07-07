<?php

namespace App\Exports;

use App\Models\PumpManagement;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class PumpManagementExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $fetchPumps = PumpManagement::with('fuelType', 'user')->where('delete_status', 1)->orderBy('id', 'desc');
        return view('backend.excel.pumpManagement', [
            'pumps' => $fetchPumps->get(),
        ]);
    }
}
