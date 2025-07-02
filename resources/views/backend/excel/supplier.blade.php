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
