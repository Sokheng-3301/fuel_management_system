<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\SaleManagement;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SaleManagementExport implements FromView
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        $query = SaleManagement::with(['customer', 'fuelType', 'user'])
            ->where('delete_status', 1)
            ->orderBy('id', 'desc');

        $data = [];

        if (!empty($this->request->query())) {
            $data['isSearch'] = true;
            $year = $this->request->query('year');
            $start_date = $this->request->query('start-date') ?
                Carbon::parse($this->request->query('start-date'))->format('Y-m-d') : '';
            $end_date = $this->request->query('end-date') ?
                Carbon::parse($this->request->query('end-date'))->format('Y-m-d') : '';

            if ($year) {
                // Year only
                $query->whereYear('sale_date', $year);
            }

            if ($start_date) {
                if ($end_date) {
                    // Between start and end date
                    $query->whereBetween('sale_date', [$start_date, $end_date]);
                } else {
                    // Start date only
                    $query->where('sale_date', '>=', $start_date);
                }
            }

            // Execute the query and get the results
            $data['sales'] = $query;
        } else {
            // Get today's sales if no filters are applied
            $data['sales'] = $query->whereDate('created_at', today());
        }

        return view('backend.excel.saleManagement', [
            'sales' => $data['sales']->get(),
        ]);
    }
}
