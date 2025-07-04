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
                                <a href="{{ route('sale.pdf') }}" class="ui button" id="pdfButton"><i
                                        class="bi bi-file-pdf icon"></i>{{ __('PDF') }}</a>
                                <a href="{{ route('sale.excel') }}" class="ui button" id="excelButton"><i
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
                                                <p><i class="icon text-muted">#</i> {{ $item->customer->customer_code }}
                                                </p>
                                                <p
                                                    class="text-capitalize {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                    <i class="bi bi-person icon text-muted"></i>
                                                    @if (session()->has('localization') && session('localization') == 'en')
                                                        {{ $item->customer->fullname_en }}
                                                    @else
                                                        {{ $item->customer->fullname_kh }}
                                                    @endif
                                                </p>
                                                <p
                                                    class="text-capitalize {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                    <i
                                                        class="bi bi-telephone icon text-muted"></i>{{ $item->customer->phone }}
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
                                                    <small class="text-muted">{{ __('Unit') }}</small>
                                                    {{ number_format($item->unit_price, 2) . ' ' . __('$') }}
                                                </p>
                                                <p>
                                                    <small class="text-muted">{{ __('Discount') }}</small>
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
                                                        <i class="bi bi-cash-coin icon text-muted"></i>
                                                        {{ __('Cash') }}
                                                    @elseif ($item->payment_method == '2')
                                                        <i class="bi bi-credit-card icon text-muted"></i>
                                                        {{ __('Credit/Debit Cards') }}
                                                    @elseif ($item->payment_method == '3')
                                                        <i class="bi bi-phone icon text-muted"></i>
                                                        {{ __('Mobile Payments') }}
                                                    @else
                                                        ($item->payment_method == 'bank_transfer')
                                                        <i class="bi bi-bank icon text-muted"></i>
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
                                                    <i class="bi bi-calendar2-week icon text-muted"></i>
                                                    {{ Carbon\Carbon::parse($item->sale_date)->format('d-m-Y') }}
                                                </p>
                                                <p class="text-capitalize"><i class="icon text-muted">#</i>
                                                    {{ $item->user->id_card ?? 'ID-000001' }}</p>
                                                <p>
                                                    <i class="bi bi-person-badge icon text-muted"></i>
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
                                                        <a href="" class="item">
                                                            <i class="bi bi-eye-fill icon"></i> {{ __('About Sale') }}
                                                        </a>

                                                        <a href="" class="item">
                                                            <i class="bi bi-printer-fill icon"></i> {{ __('Invoice') }}
                                                        </a>

                                                        <a href="{{ route('customer.edit', $item->id) }}" class="item">
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
            $(document).on('click', '#buttonHide', function() {
                let id = $(this).data('id');
                var url = "{{ route('customer.destroy', ':id') }}".replace(':id', id);
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
                var url = "{{ route('customer.destroy', ':id') }}".replace(':id', id);

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


            $("#yearly").yearpicker();

        });
    </script>
@endsection
