<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/dataTables.bootstrap5.min.css') }}"> --}}
    <title>{{ __('Pump Management') }}</title>
    <style>
        * {
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

        th,
        td {
            border: 1px solid black !important;
            padding: 8px !important;
            text-align: left !important;
        }

        p {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <h4 class="text-center">{{ __('Pump Management') }}</h4>
    <p>{{ __('Export date') }} : {{ now()->format('d-m-Y h:i:s A') }}</p>

    <table class="table table-hover" id="myTable">
        <thead>
            <tr>
                <th scope="col" class="text-start">{{ __('No.') }}</th>
                <th scope="col" class="text-start">{{ __('Pump Number') }}</th>
                <th scope="col" class="text-start">{{ __('Fuel Type') }}</th>
                <th scope="col" class="text-start">{{ __('Status') }}</th>
                <th scope="col" class="text-start">{{ __('Create Info') }}</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($pumps as $item)
                <tr class="{{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                    <th scope="row" class="text-center {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                        {{ $i }}</th>

                    <td class="text text-start {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                        <p>{{ $item->pump_code }}</p>
                    </td>

                    <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                        <p>{{ $item->fuelType->fuel_type_kh }}</p>
                        <p class="text-capitalize">{{ $item->fuelType->fuel_type_en }}</p>
                    </td>

                    <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                        <div class="ui small label text-start {{ $item->status == 1 ? 'green' : 'red' }}">
                            {{ $item->status == 1 ? __('Active') : __('Inactive') }}
                        </div>
                    </td>

                    <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                        <p class="{{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                            <i
                                class="bi bi-calendar2-week icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}"></i>
                            {{ Carbon\Carbon::parse($item->sale_date)->format('d-m-Y') }}
                        </p>
                        <p class="text-capitalize"><i
                                class="icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}">#</i>
                            {{ $item->user->id_card ?? 'ID-000001' }}</p>
                        <p>
                            <i
                                class="bi bi-person-badge icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}"></i>
                            @if (session('localization') == 'en')
                                {{ $item->user->fullname_en }}
                            @else
                                {{ $item->user->fullname_kh }}
                            @endif
                        </p>
                    </td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
</body>

</html
