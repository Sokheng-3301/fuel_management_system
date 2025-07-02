<?php

namespace App\Exports;

use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromCollection;

class SupplierExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $suppliers = Supplier::with('user')->where('delete_status', 1)
            ->orderBy('created_at', 'desc');
        return view('backend.excel.supplier', [
            'suppliers' => $suppliers->get(),
        ]);
    }
}
