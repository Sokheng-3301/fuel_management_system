<h4 class="text-center">{{ __('Todays Fuel Price') }}</h4>
<p>{{ __('Export date') }} : {{ now()->format('d-m-Y h:i:s A') }}</p>

<table class="table table-hover" id="myTable">
    <thead>
        <tr>
            <th scope="col" class="text-start">{{ __('No.') }}</th>
            <th scope="col" class="text-start">{{ __('Customer Info') }}</th>
            <th scope="col" class="text-start">{{ __('Fuel Type') }}</th>
            <th scope="col" class="text-start">{{ __('Vichle Number') }}</th>
            <th scope="col" class="text-start">{{ __('Quantity') }}</th>
            <th scope="col" class="text-start">{{ __('Amount') }}</th>
            <th scope="col" class="text-start">{{ __('Payment Method') }}</th>
            <th scope="col" class="text-start">{{ __('Date') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sales as $index => $item)
            <tr class="">
                <th scope="row" class="text-center ">
                    {{ $index + 1 }}
                </th>

                <td class="text ">
                    <p><i class="icon ">#</i>
                        {{ $item->customer->customer_code }}
                    </p>
                    <p class="text-capitalize ">
                        <i class="bi bi-person icon "></i>
                        @if (session()->has('localization') && session('localization') == 'en')
                            {{ $item->customer->fullname_en }}
                        @else
                            {{ $item->customer->fullname_kh }}
                        @endif
                    </p>
                    <p class="text-capitalize ">
                        <i class="bi bi-telephone icon "></i>{{ $item->customer->phone }}
                    </p>
                </td>

                <td class="text ">
                    <p class="text-capitalize ">
                        {{ $item->fuelType->fuel_type_kh }}
                    </p>
                    <p class="text-capitalize ">
                        {{ $item->fuelType->fuel_type_en }}
                    </p>
                    {{-- <p class="text-capitalize "><i class="bi bi-telephone icon text-muted"></i>{{ $item->customer->phone }}</p> --}}
                </td>

                <td class="text-uppercase ">
                    {{ $item->vichle_number }}
                </td>


                <td class="text">
                    <p class="">
                        {{ $item->quantity . ' ' . __('L') }}
                    </p>
                </td>

                <td class="text ">
                    <p>
                        <small class="">{{ __('Unit') }}</small>
                        {{ number_format($item->unit_price, 2) . ' ' . __('$') }}
                    </p>
                    <p>
                        <small class="">{{ __('Discount') }}</small>
                        {{ number_format($item->discount, 2) . ' ' . __('%') }}
                    </p>
                    <p class="text-capitalize fw-bold text-danger">
                        <small>{{ __('Total') }}</small>
                        {{ number_format($item->total_price, 2) . ' ' . __('$') }}
                    </p>
                </td>

                <td class="text ">
                    <p class="text-capitalize">
                        @if ($item->payment_method == '1')
                            <i class="bi bi-cash-coin icon "></i>
                            {{ __('Cash') }}
                        @elseif ($item->payment_method == '2')
                            <i class="bi bi-credit-card icon "></i>
                            {{ __('Credit/Debit Cards') }}
                        @elseif ($item->payment_method == '3')
                            <i class="bi bi-phone icon "></i>
                            {{ __('Mobile Payments') }}
                        @else
                            ($item->payment_method == 'bank_transfer')
                            <i class="bi bi-bank icon "></i>
                            {{ __('Bank Transfers') }}
                        @endif
                    </p>
                    <p class="mt-1 text-start">
                        <a class="ui tiny {{ $item->status == '1' ? __('teal') : 'brown' }} label">
                            <i class="bi {{ $item->status == '1' ? 'bi-check-lg' : 'bi-hourglass-bottom' }} icon"></i>
                            {{ $item->status == '1' ? __('Completed') : __('Pendding') }}
                        </a>
                    </p>
                    @if ($item->status == '0')
                        <p class="mt-1 text-start" id="buttonComplete" data-id="{{ $item->id }}"
                            style="cursor: pointer; ">
                            <small class="makeDone">{{ __('Make as completed') }}</small>
                        </p>
                    @endif
                </td>

                <td class="text ">
                    <p class="">
                        <i class="bi bi-calendar2-week icon "></i>
                        {{ Carbon\Carbon::parse($item->sale_date)->format('d-m-Y') }}
                    </p>
                    <p class="text-capitalize"><i class="icon ">#</i>
                        {{ $item->user->id_card ?? 'ID-000001' }}</p>
                    <p>
                        <i class="bi bi-person-badge icon "></i>
                        @if (session('localization') == 'en')
                            {{ $item->user->fullname_en }}
                        @else
                            {{ $item->user->fullname_kh }}
                        @endif
                    </p>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
