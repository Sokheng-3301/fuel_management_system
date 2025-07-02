<h4 class="text-center">{{ __('Todays Fuel Price') }}</h4>
<p>{{ __('Export date') }} : {{ now()->format('d-m-Y h:i:s A') }}</p>

<table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th>{{ __('No.') }}</th>
            <th>{{ __('Fuel Type') }}</th>
            <th>{{ __('Fuel Price') }}</th>
            <th>{{ __('Edit Date') }}</th>
            <th>{{ __('Editor Name') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($fuels as $key => $fuel)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>
                    <p>{{ $fuel->fuel_type_kh }}</p>
                    <p>{{ $fuel->fuel_type_en }}</p>
                </td>
                <td>{{ number_format($fuel->today_price, 2) }} {{ __('USD') }}</td>
                <td>{{ $fuel->updated_at->format('d-m-Y h:i:s A') }}</td>
                <td>{{ $fuel->user->fullname_kh ?? __('N/A') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
