<h4 class="text-center">{{ __('Fuel Inventory List') }}</h4>
<p>{{ __('Export date') }} : {{ now()->format('d-m-Y h:i:s A') }}</p>

<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th scope="col" class="text-start">{{ __('No.') }}</th>
            <th scope="col">{{ __('Fuel Code') }}</th>
            <th scope="col">{{ __('Fuel Type') }}</th>
            <th scope="col">{{ __('Supplier') }}</th>
            <th scope="col">{{ __('Quantity') }}</th>
            <th scope="col" class="text-start">{{ __('Unit Price') }}</th>
            <th scope="col" class="text-start">{{ __('Total Price') }}</th>
            <th scope="col" colspan="2" class="text-start">{{ __('Date Listed') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fuels as $key => $item)
            <tr>
                <th scope="row" class="text-center">
                    {{ $key + 1 }}</th>
                <td class="text text-uppercase">
                    <p>
                        {{ $item->fuel_code }}
                    </p>
                    <p>
                        @if ($item->qty == 0)
                            <span class="text-muted ui small red label"><i
                                    class="bi bi-thermometer icon"></i>{{ __('Out of Stock') }}</span>
                        @elseif($item->qty > 10 && $item->qty <= 50)
                            <span class="text-warning ui small teal label"><i
                                    class="bi bi-thermometer-half icon"></i>{{ __('Medium Stock') }}</span>
                        @elseif($item->qty > 50)
                            <span class="text-success ui small blue label"><i
                                    class="bi bi-thermometer-high icon"></i>{{ __('High Stock') }}</span>
                        @else
                            <span class="text-danger ui small yellow label"><i
                                    class="bi bi-thermometer-low icon"></i>{{ __('Low Stock') }}</span>
                        @endif
                    </p>
                </td>
                <td class="text">
                    <p>{{ $item->fuelType->fuel_type_kh }}</p>
                    <p class="text-capitalize">{{ $item->fuelType->fuel_type_en }}</p>
                </td>

                <td class="text">
                    <p>{{ $item->supplier->fullname_kh }}</p>
                    <p class="text-capitalize">{{ $item->supplier->fullname_en }}</p>
                </td>
                <td class="text">
                    <p>
                        {{ $item->qty ?? '0.00' }}<span class="ps-2"> {{ __('L') }}</span>
                    </p>

                </td>
                <td class="text-start"><i class="bi bi-currency-dollar icon"></i>USD {{ $item->unit_price ?? '0.00' }}
                <td class="text-start"><i class="bi bi-currency-dollar icon"></i>USD {{ $item->total_price ?? '0.00' }}
                </td>
                <td class="text-start">
                    {{ \Carbon\Carbon::parse($item->created_at)->format('d m Y - h:i:s A') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
