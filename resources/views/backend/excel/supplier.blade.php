<h4 class="text-center">{{ __('Supplier List') }}</h4>
<p>{{ __('Export date') }} : {{ now()->format('d-m-Y h:i:s A') }}</p>

<table>
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
            <tr>
                <th scope="row" class="text-center">
                    {{ $key + 1 }}</th>

                <td class="text-start">
                    {{ $item->supplier_code }}
                </td>
                <td class="text">
                    <p>{{ $item->fullname_kh }}</p>
                    <p class="text-capitalize">{{ $item->fullname_en }}</p>
                </td>
                <td class="text-start text">
                    <p>
                        {{ $item->email }}
                    </p>
                    <p>
                        {{ $item->phone }}
                    </p>
                </td>
                <td class="text">
                    {{ $item->address }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
