<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link rel="stylesheet" href="{{ asset('dist/css/dataTables.bootstrap5.min.css') }}"> --}}
    <title>{{ __('Supplier') }}</title>
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
    <h4 class="text-center">{{ __('Supplier List') }}</h4>
    <p>{{ __('Export date') }} : {{ now()->format('d-m-Y h:i:s A') }}</p>

    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th scope="col" class="text-start">{{ __('No.') }}</th>
                <th scope="col" class="text-start">{{ __('Supplier ID') }}</th>
                <th scope="col" class="text-start">{{ __('Supplier Name') }}</th>
                <th scope="col" class="text-start">{{ __('Contact Info') }}</th>
                <th scope="col" class="text-start">{{ __('Address') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $key => $item)
                <tr class="{{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                    <th scope="row" class="text-center {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                        {{ $key + 1 }}</th>

                    <td class="text-start {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                        {{ $item->supplier_code }}
                    </td>

                    <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                        <p>{{ $item->fullname_kh }}</p>
                        <p class="text-capitalize">{{ $item->fullname_en }}</p>
                    </td>

                    <td class="text-start text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                        <p> <i
                                class="bi bi-envelope-at icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}"></i>
                            <a href="mailto:{{ $item->email }}"
                                class="{{ $item->delete_status == 0 ? 'text-danger' : 'stretched-link' }}">{{ $item->email }}</a>
                        </p>
                        <p><i
                                class="bi bi-telephone icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}"></i>
                            <a href="tel:{{ $item->phone }}"
                                class="{{ $item->delete_status == 0 ? 'text-danger' : 'stretched-link' }}">{{ $item->phone }}</a>
                        </p>
                    </td>

                    <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                        {{ $item->address }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html
