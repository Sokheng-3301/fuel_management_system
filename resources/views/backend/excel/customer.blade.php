<h4 class="text-center">{{ __('Supplier List') }}</h4>
<p>{{ __('Export date') }} : {{ now()->format('d-m-Y h:i:s A') }}</p>

<table>
        <thead>
            <tr>
                <th scope="col">{{ __('No.') }}</th>
                <th scope="col">{{ __('Customer Code') }}</th>
                <th scope="col">{{ __('Customer Name') }}</th>
                <th scope="col">{{ __('Contact Info') }}</th>
                <th scope="col">{{ __('Address') }}</th>
                <th scope="col">{{ __('Other') }}</th>
                <th scope="col">{{ __('Create Info') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($customers as $index => $item)
                <tr class="">
                    <th scope="row">
                        {{ $index + 1 }}
                    </th>
                    <td>
                        {{ $item->customer_code }}
                    </td>
                    <td class="text ">
                        <p>{{ $item->fullname_kh }}</p>
                        <p class="text-capitalize">{{ $item->fullname_en }}</p>
                    </td>
                    <td class="text-start text ">
                        <p>
                           {{ $item->phone }}
                        </p>
                        @if ($item->email)
                            <p>
                                {{ $item->email }}
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
