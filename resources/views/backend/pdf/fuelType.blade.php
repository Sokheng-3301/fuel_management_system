<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/dataTables.bootstrap5.min.css') }}"> --}}
    <title>{{__("Todays Fuel Price")}}</title>
    <style>
        *{
            margin: 0 !important;
            padding: 0 !important;
            box-sizing: border-box;
            font-size: 11px !important;
            font-family: 'KhmerOS', sans-serif !important;
        }
        table {
            width: 100% !important;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black !important;
            padding: 8px !important;
            text-align: left !important;
        }
        p{
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h4 class="text-center">{{__('Todays Fuel Price')}}</h4>
    <p>{{__("Export date")}} : {{now()->format('d-m-Y h:i:s A')}}</p>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>{{__('No.')}}</th>
                <th>{{__('Fuel Type')}}</th>
                <th>{{__('Fuel Price')}}</th>
                <th>{{__('Edit Date')}}</th>
                <th>{{__('Editor Name')}}</th>
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
</body>
</html
