@extends('backend.layout.master')
@section('title')
    {{ __('Sale Management') }}
@endsection
@section('css')
    <style>
        .makeDone {
            transition: all 0.2s;
            color: #2185d0;
            text-decoration: underline;
        }

        .makeDone:hover {
            color: #29a2ff;
        }
    </style>
@endsection
@section('content')
    <!--begin::Row-->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 connectedSortable">
            <!-- /.card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title"><i class="bi bi-search icon"></i> {{ __('Filter Sale Management') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form action="" class="ui form" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="three fields">
                                            <div class="field">
                                                <div class="ui labeled input">
                                                    <label for="yearly" class="ui label">
                                                        {{ __('Yearly') }}
                                                    </label>
                                                    <input type="text" name="year" id="yearly"
                                                        value="{{ request('year') }}">
                                                </div>
                                            </div>
                                            <div class="field">
                                                <div class="ui labeled input icon">
                                                    <label for="startDate" class="ui label">
                                                        {{ __('Start Date') }}
                                                    </label>
                                                    {{-- <div class="input icon"> --}}
                                                    <input type="search" class="startDate"
                                                        placeholder="{{ __('mm/dd/yy') }}" name="start-date" id="startDate"
                                                        value="{{ request('start-date') }}">

                                                    <i class="bi bi-calendar2 icon"></i>
                                                    {{-- </div> --}}
                                                </div>
                                            </div>
                                            <div class="field">
                                                <div class="ui labeled input icon">
                                                    <label for="endDate" class="ui label">
                                                        {{ __('End Date') }}
                                                    </label>
                                                    <input type="search" class="endDate" placeholder="{{ __('mm/dd/yy') }}"
                                                        name="end-date" id="endDate" value="{{ request('end-date') }}">
                                                    <i class="bi bi-calendar2 icon"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="field text-end">
                                            <button type="button" id="resetButton" class="ui small button"><i
                                                    class="bi bi-x-lg icon"></i> {{ __('Reset') }} </button>
                                            <button type="submit" class="ui small primary button"> <i
                                                    class="bi bi-search icon"></i>{{ __('Search') }} </button>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="col-lg-12 connectedSortable">
            <!-- /.card -->
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary mb-4">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Sale Management List') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                        <a href="{{ route('sale.create') }}" class="ui button small blue"><i
                                class="bi bi-plus-circle-fill icon"></i>{{ __('Add new') }}</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-3">
                    @if ($isSearch)
                        <div class="row mb-3">
                            <div class="col-md-12 ">
                                <p class="text-muted"><i class="bi bi-search icon"></i>{{ __('Search Resutls:') }} <span
                                        class="text-primary">{{ __('Yearly') . ' : ' . request('year') . ' - ' . __('Start Date') . ' : ' . request('start-date') . ' - ' . __('End Date') . ' : ' . request('end-date') }}</span>
                                </p>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="ui buttons tiny">
                                <button class="ui button" id="printButton"><i
                                        class="bi bi-printer icon"></i>{{ __('Print') }}</button>
                                <a href="{{ route('sale.pdf', request()->all()) }}" class="ui button" id="pdfButton"><i
                                        class="bi bi-file-pdf icon"></i>{{ __('PDF') }}</a>
                                <a href="{{ route('sale.excel', request()->all()) }}" class="ui button" id="excelButton"><i
                                        class="bi bi-file-earmark-spreadsheet icon"></i>{{ __('Excel') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div class="myresponsive">
                            <div class="bg-table-loader">
                                <div class="loader"></div>
                            </div>
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
                                        <th scope="col" class="text-start" colspan="2">{{ __('Date') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $index => $item)
                                        <tr class="{{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                            <th scope="row"
                                                class="text-center {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                {{ $index + 1 }}
                                            </th>

                                            <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                <p><i class="icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}">#</i> {{ $item->customer->customer_code }}
                                                </p>
                                                <p
                                                    class="text-capitalize {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                    <i class="bi bi-person icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}"></i>
                                                    @if (session()->has('localization') && session('localization') == 'en')
                                                        {{ $item->customer->fullname_en }}
                                                    @else
                                                        {{ $item->customer->fullname_kh }}
                                                    @endif
                                                </p>
                                                <p
                                                    class="text-capitalize {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                    <i
                                                        class="bi bi-telephone icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}"></i>{{ $item->customer->phone }}
                                                </p>
                                            </td>

                                            <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                <p
                                                    class="text-capitalize {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                    {{ $item->fuelType->fuel_type_kh }}
                                                </p>
                                                <p
                                                    class="text-capitalize {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                    {{ $item->fuelType->fuel_type_en }}
                                                </p>
                                                {{-- <p class="text-capitalize {{ $item->delete_status == 0 ? 'text-danger' : '' }}"><i class="bi bi-telephone icon text-muted"></i>{{ $item->customer->phone }}</p> --}}
                                            </td>

                                            <td
                                                class="text-uppercase {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                {{ $item->vichle_number }}
                                            </td>


                                            <td class="text">
                                                <p class="{{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                    {{ $item->quantity . ' ' . __('L') }}
                                                </p>
                                            </td>

                                            <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                <p>
                                                    <small class="{{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}">{{ __('Unit') }}</small>
                                                    {{ number_format($item->unit_price, 2) . ' ' . __('$') }}
                                                </p>
                                                <p>
                                                    <small class="{{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}">{{ __('Discount') }}</small>
                                                    {{ number_format($item->discount, 2) . ' ' . __('%') }}
                                                </p>
                                                <p class="text-capitalize fw-bold text-danger">
                                                    <small>{{ __('Total') }}</small>
                                                    {{ number_format($item->total_price, 2) . ' ' . __('$') }}
                                                </p>
                                            </td>

                                            <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                <p class="text-capitalize">
                                                    @if ($item->payment_method == '1')
                                                        <i class="bi bi-cash-coin icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}"></i>
                                                        {{ __('Cash') }}
                                                    @elseif ($item->payment_method == '2')
                                                        <i class="bi bi-credit-card icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}"></i>
                                                        {{ __('Credit/Debit Cards') }}
                                                    @elseif ($item->payment_method == '3')
                                                        <i class="bi bi-phone icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}"></i>
                                                        {{ __('Mobile Payments') }}
                                                    @else
                                                        ($item->payment_method == 'bank_transfer')
                                                        <i class="bi bi-bank icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}"></i>
                                                        {{ __('Bank Transfers') }}
                                                    @endif
                                                </p>
                                                <p class="mt-1 text-start">
                                                    <a
                                                        class="ui tiny {{ $item->status == '1' ? __('teal') : 'brown' }} label">
                                                        <i
                                                            class="bi {{ $item->status == '1' ? 'bi-check-lg' : 'bi-hourglass-bottom' }} icon"></i>
                                                        {{ $item->status == '1' ? __('Completed') : __('Pendding') }}
                                                    </a>
                                                </p>
                                                @if ($item->status == '0')
                                                    <p class="mt-1 text-start" id="buttonComplete"
                                                        data-id="{{ $item->id }}" style="cursor: pointer; ">
                                                        <small class="makeDone">{{ __('Make as completed') }}</small>
                                                    </p>
                                                @endif
                                            </td>

                                            <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                <p class="{{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                    <i class="bi bi-calendar2-week icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}"></i>
                                                    {{ Carbon\Carbon::parse($item->sale_date)->format('d-m-Y') }}
                                                </p>
                                                <p class="text-capitalize"><i class="icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}">#</i>
                                                    {{ $item->user->id_card ?? 'ID-000001' }}</p>
                                                <p>
                                                    <i class="bi bi-person-badge icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}"></i>
                                                    @if (session('localization') == 'en')
                                                        {{ $item->user->fullname_en }}
                                                    @else
                                                        {{ $item->user->fullname_kh }}
                                                    @endif
                                                </p>
                                            </td>

                                            <td class="text-end {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                <div
                                                    class="ui scrolling pointing icon button nimi p-1 circular dropdown dropdown{{ $index + 1 }}">
                                                    <i class="bi bi-three-dots-vertical icon"></i>
                                                    <div class="menu left">
                                                        <a href="{{ route('sale.show', $item->id) }}" class="item">
                                                            <i class="bi bi-eye-fill icon"></i> {{ __('About Sale') }}
                                                        </a>

                                                        <a type="button" data-id="{{ $item->id }}" class="item"
                                                            id="invoiceButtonDetail">
                                                            <i class="bi bi-receipt icon"></i> {{ __('Invoice') }}
                                                        </a>

                                                        <a href="{{ route('sale.edit', $item->id) }}" class="item">
                                                            <i class="bi bi-pencil-square icon"></i> {{ __('Update') }}
                                                        </a>
                                                        <div class="item" data-id="{{ $item->id }}"
                                                            id="{{ $item->delete_status == 1 ? 'buttonHide' : 'buttonShow' }}">
                                                            <i
                                                                class="bi {{ $item->delete_status == 1 ? 'bi-trash-fill' : 'bi-recycle' }} icon"></i>
                                                            {{ $item->delete_status == 1 ? __('Move to Trash') : __('Restore') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.direct-chat -->
        </div>
    </div>
    <!-- /.row (main row) -->

    <!-- Modal Invoice -->
    <div class="modal fade" id="invoiceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Invoice') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-3">
                    <div class="row">
                        <div class="col-md-12" id="invoice">
                            <div class="row">
                                <div class="col-6">
                                    <img src="{{ asset('dist/assets/img/logo.png') }}" alt="FMS-Logo" class="ui image"
                                        width="100px">
                                    {{-- <small>{{config('app.name')}}</small> --}}
                                </div>
                                <div class="col-6 text-end normal-text">
                                    <h5 class="text-end ui header medium text-uppercase">{{ __('Invoice') }}</h5>
                                    <p>No : <span id="sale_code"></span></p>
                                    <p>{{ __('Date') }} : <span id="sale_date"></span></p>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">[ {{ __('Customer Code') }} : # <span id="customer_code"></span> ]
                                </div>
                                <div class="col-12 mt-1">[ {{ __('Customer Name') }} : <span id="fullname_kh"></span>
                                    - <span class="text-uppercase" id="fullname_en"></span> ]</div>
                                <div class="col-12 mt-1"><i class="bi bi-car-front icon"></i>#<span
                                        id="vichle_number"></span>
                                </div>
                                <div class="col-12 mt-1"><i class="bi bi-telephone icon"></i>(+855) <span
                                        id="phone"></span></div>
                                <div class="col-12 mt-1"><i class="bi bi-envelope-at icon"></i> <span
                                        id="email"></span> </div>
                                <div class="col-12 mt-1"><i class="bi bi-geo-alt icon"></i><span id="address"></span>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                {{-- <th>{{__("No.")}}</th> --}}
                                                <th>{{ __('Description') }}</th>
                                                <th>{{ __('Quantity') }}</th>
                                                <th>{{ __('Unit Price') }}</th>
                                                <th>{{ __('Discount') }}</th>
                                                <th>{{ __('Amount') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                {{-- <th>1</th> --}}
                                                <td id="noted"></td>
                                                <td><span id="quantity"></span> {{ __('L') }}</td>
                                                <td><span id="unit_price"></span> $</td>
                                                <td><span id="discount"></span> %</td>
                                                <td><span id="total_price"></span> $</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end">{{ __('Total') }}</td>
                                                <th><span id="total_price_all"></span> $</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <p class="text-center">{{ __('Thank you for being so supportive of our service.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="ui button tiny red" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button class="ui blue tiny button" id="printInvoiceBtn"><i
                            class="bi bi-printer-fill icon"></i>{{ __('Print') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @php
            $i = 1;
        @endphp
        @foreach ($sales as $index => $sale)
            $(".dropdown{{ $i++ }}").dropdown();

            $('.popup-text-{{ $index + 1 }}').popup({
                inline: true,
                hoverable: true,
                position: 'top left',
            });
            $('.some-wrapping-div .custom.button')
                .popup({
                    popup: $('.custom.popup'),
                    on: 'click'
                });
        @endforeach
    </script>
    <script>
        $(document).ready(function() {
            $("#yearly").yearpicker();

            $(document).on('click', '#buttonHide', function() {
                let id = $(this).data('id');
                var url = "{{ route('sale.destroy', ':id') }}".replace(':id', id);
                let button = $(this); // Store the button reference

                Swal.fire({
                    title: "{{ __('Move to Trash') }}",
                    text: "{{ __('Are you sure you want to move to trash?') }}",
                    icon: "question",
                    iconHtml: "<i class='bi bi-trash-fill icon'></i>",
                    confirmButtonText: "{{ __('Yes, Move it') }}",
                    cancelButtonText: "{{ __('No, Cancel') }}",
                    showCancelButton: true,
                    showCloseButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Disable the button to prevent double submission
                        button.prop('disabled', true);


                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "{{ __('Success') }}",
                                    text: response.message,
                                    icon: "success",
                                    draggable: true,
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: "{{ __('Error') }}",
                                    text: xhr.responseJSON.message ||
                                        "{{ __('Something went wrong!') }}",
                                    icon: "error",
                                    confirmButtonText: "{{ __('Okay') }}"
                                });
                            },
                            complete: function() {
                                // Re-enable the button after the request is complete
                                button.prop('disabled', false);
                            }
                        });
                    }
                });
            });

            $(document).on('click', '#buttonShow', function() {
                let id = $(this).data('id');
                var url = "{{ route('sale.destroy', ':id') }}".replace(':id', id);

                Swal.fire({
                    title: "{{ __('Restore') }}",
                    text: "{{ __('Are you sure you want to restore?') }}",
                    icon: "question",
                    iconHtml: "<i class='bi bi-arrow-clockwise icon'></i>",
                    confirmButtonText: "{{ __('Yes, Restore it') }}",
                    cancelButtonText: "{{ __('No, Cancel') }}",
                    showCancelButton: true,
                    showCloseButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Disable the button to prevent double submission
                        $(this).prop('disabled', true);

                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "{{ __('Success') }}",
                                    text: response.message,
                                    icon: "success",
                                    draggable: true,
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: "{{ __('Error') }}",
                                    text: xhr.responseJSON.message ||
                                        "{{ __('Something went wrong!') }}",
                                    icon: "error",
                                    confirmButtonText: "{{ __('Okay') }}"
                                });
                            },
                            complete: function() {
                                // Re-enable the button after the request is complete
                                $(this).prop('disabled', false);
                            }
                        });
                    }
                });
            });

            ///Make as Completed
            $(document).on('click', '#buttonComplete', function() {
                let id = $(this).data('id');
                var url = "{{ route('sale.complete', ':id') }}".replace(':id', id);
                // alert(id);

                Swal.fire({
                    icon: "question",
                    title: "{{ __('Are you sure?') }}",
                    text: "{{ __('Do you want to make this sale as completed?') }}",
                    showCancelButton: true,
                    confirmButtonText: "{{ __('Yes, Make it') }}",
                    cancelButtonText: "{{ __('No, Cancel') }}",
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Disable the button to prevent double submission
                        $(this).prop('disabled', true);

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "{{ __('Success') }}",
                                    text: response.message,
                                    icon: "success",
                                    draggable: true,
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: "{{ __('Error') }}",
                                    text: xhr.responseJSON.message ||
                                        "{{ __('Something went wrong!') }}",
                                    icon: "error",
                                    confirmButtonText: "{{ __('Okay') }}"
                                });
                            },
                            complete: function() {
                                // Re-enable the button after the request is complete
                                $(this).prop('disabled', false);
                            }
                        });
                    }
                });
            });

            $(document).on('click', '#resetButton', function() {
                window.location.href = "{{ route('sale.index') }}";
            });


            // $('#invoiceModal').modal('show');

            $(document).on('click', '#invoiceButtonDetail', function() {
                var id = $(this).data('id');
                var url = "{{ route('sale.invoice', ':id') }}".replace(':id', id);

                $.ajax({
                    url: url,
                    type: 'GET',
                    data: 'json',
                    success: function(response) {
                        $('#invoiceModal').modal('show');
                        $('#sale_code').text(response.data.sale_code);
                        $('#sale_date').text(moment(response.data.sale_date).format('DD-MM-YYYY'));
                        $('#customer_code').text(response.data.customer.customer_code);
                        $('#fullname_kh').text(response.data.customer.fullname_kh);
                        $('#fullname_en').text(response.data.customer.fullname_en);
                        $('#vichle_number').text(response.data.vichle_number);
                        $('#phone').text(response.data.customer.phone);
                        $('#email').text(response.data.customer.email);
                        $('#address').text(response.data.customer.address);



                        $('#noted').text(response.data.note);
                        $('#quantity').text(response.data.quantity);
                        $('#unit_price').text(response.data.unit_price);
                        $('#discount').text(response.data.discount);
                        $('#total_price').text(response.data.total_price);
                        $('#total_price_all').text(response.data.total_price);
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: "{{ __('Error') }}",
                            text: xhr.responseJSON.message ||
                                "{{ __('Something went wrong!') }}",
                            icon: "error",
                            confirmButtonText: "{{ __('Okay') }}"
                        });
                    },

                });
            });

             $(document).on('click', '#printInvoiceBtn', function() {
            var content = $('#invoice').html();
            var myWindow = window.open('', '', 'width=800,height=500');
            myWindow.document.write(`
            <html><head>
                <title>Print Invoice</title>
                <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}" />
                <style>
                    @font-face {
                        font-family: 'Akbaltom Nagar';
                        src: url('/fonts/AKbalthom-Naga.ttf') format('truetype');
                        font-weight: normal;
                    }
                    @font-face {
                        font-family: 'Poppins';
                        src: url('/fonts/Poppins-Regular.ttf') format('truetype');
                        font-weight: normal;
                    }
                    * {
                        font-family: 'Poppins', 'Lato', 'Helvetica Neue', 'Akbaltom Nagar', sans-serif !important;
                    }
                    body{
                        margin: 15px !important;
                    }
                </style>
            `);
            myWindow.document.write('</head><body>');
            myWindow.document.write(content);
            myWindow.document.write('</body></html>');
            myWindow.document.close();
            myWindow.print();
        });
        });
    </script>
@endsection
