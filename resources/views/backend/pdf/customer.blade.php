<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/dataTables.bootstrap5.min.css') }}"> --}}
    <title>{{ __('Customer') }}</title>
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
            font-size: 11px !important;
        }
    </style>
</head>

<body>
    <h4 class="text-center">{{ __('Customer List') }}</h4>
    <p>{{ __('Export date') }} : {{ now()->format('d-m-Y h:i:s A') }}</p>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th scope="col" class="text-start">{{ __('No.') }}</th>
                <th scope="col" class="text-start">{{ __('Customer Code') }}</th>
                <th scope="col" class="text-start">{{ __('Customer Name') }}</th>
                <th scope="col" class="text-start">{{ __('Contact Info') }}</th>
                <th scope="col" class="text-start" style="width: 13%">{{ __('Address') }}</th>
                <th scope="col" class="text-start" style="width: 10%">{{ __('Other') }}</th>
                <th scope="col" class="text-start">{{ __('Create Info') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $index => $item)
                <tr class="">
                    <th scope="row" class="text-center ">
                        {{ $index + 1 }}
                    </th>
                    <td class="text-start ">
                        {{ $item->customer_code }}
                    </td>
                    <td class="text ">
                        <p>{{ $item->fullname_kh }}</p>
                        <p class="text-capitalize">{{ $item->fullname_en }}</p>
                    </td>
                    <td class="text-start text ">
                        <p>
                            <a class=""
                                href="tel:{{ $item->phone }}">{{ $item->phone }}</a>
                        </p>
                        @if ($item->email)
                            <p>
                                <a class=""
                                    href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                            </p>
                        @endif
                    </td>
                    <td
                        class="text  popup-text-{{ $index + 1 }}">
                        <p>
                            {{ $item->address }}
                        </p>
                    </td>
                    <td class="text ">
                        {{ $item->note }}
                    </td>
                    <td class="text ">
                        <p>{{ $item->user->fullname_kh }}</p>
                        <p class="text-capitalize">{{ $item->user->fullname_en }}</p>
                        <p class="{{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}">
                            {{ Carbon\Carbon::parse($item->updated_at)->format('d m Y - h:i:s A') }}
                        </p>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html
