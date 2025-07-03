<?php

namespace App\Exports;

use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CustomerExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $customers = Customer::with('user')->where('delete_status', 1)
            ->orderBy('created_at', 'desc');
        return view('backend.excel.customer', [
            'customers' => $customers->get(),
        ]);
    }
}
