@extends('backend.layout.master')
@section('title')
    {{ __('Fuel Inventory') }}
@endsection
@section('content')
    <!--begin::Row-->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 connectedSortable">
            <!-- /.card -->
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary mb-4">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Fuel Inventory List') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                        <a href="{{ route('fuel.create') }}" class="ui button small blue"><i
                                class="bi bi-plus-circle-fill icon"></i>{{ __('Add new') }}</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <div class="ui buttons tiny">
                                <button class="ui button" id="printButton"><i
                                        class="bi bi-printer icon"></i>{{ __('Print') }}</button>
                                <button class="ui button"><i class="bi bi-file-pdf icon"></i>{{ __('PDF') }}</button>
                                <button class="ui button"><i
                                        class="bi bi-file-earmark-spreadsheet icon"></i>{{ __('Excel') }}</button>
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
                                        <th scope="col">{{ __('Fuel Code') }}</th>
                                        <th scope="col">{{ __('Fuel Type') }}</th>
                                        <th scope="col">{{ __('Supplier') }}</th>
                                        <th scope="col">{{ __('Quantity') }}</th>
                                        <th scope="col" class="text-start">{{ __('Unit Price') }}</th>
                                        <th scope="col" class="text-start">{{ __('Total Price') }}</th>
                                        <th scope="col" colspan="2" class="text-start">{{ __('Date Listed') }}</th>
                                        {{-- <th scope="col">{{__('Actions')}}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fuels as $key => $item)
                                        <tr>
                                            <th scope="row"
                                                class="text-center {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                {{ $key + 1 }}</th>
                                            <td
                                                class="text-uppercase {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                {{ $item->fuel_code }}</td>
                                            <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                <p>{{ $item->fuelType->fuel_type_kh }}</p>
                                                <p class="text-capitalize">{{ $item->fuelType->fuel_type_en }}</p>
                                            </td>

                                            <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                <p>{{ $item->supplier->fullname_kh }}</p>
                                                <p class="text-capitalize">{{ $item->supplier->fullname_en }}</p>
                                            </td>
                                            <td class="{{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                {{ $item->qty ?? '0.00' }}<span
                                                    class="ps-2 text-muted">{{ __('L') }}</span></td>
                                            <td class="text-start {{ $item->delete_status == 0 ? 'text-danger' : '' }}"><i
                                                    class="bi bi-currency-dollar icon text-muted"></i>{{ $item->unit_price ?? '0.00' }}
                                            <td class="text-start {{ $item->delete_status == 0 ? 'text-danger' : '' }}"><i
                                                    class="bi bi-currency-dollar icon text-muted"></i>{{ $item->total_price ?? '0.00' }}
                                            </td>
                                            <td
                                                class="text-start {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}">
                                                {{ \Carbon\Carbon::parse($item->created_at)->format('d m Y - h:i:s A') }}
                                            </td>
                                            <td class="text-end">
                                                <div
                                                    class="ui scrolling pointing icon button nimi p-1 circular dropdown dropdown{{ $key + 1 }}">
                                                    <i class="bi bi-three-dots-vertical icon"></i>
                                                    <div class="menu left">
                                                        <div class="item"><i
                                                                class="bi bi-eye-fill icon"></i>{{ __('About Fuel') }}
                                                        </div>
                                                        <a href="{{ route('fuel.edit', $item->id) }}" class="item"><i
                                                                class="bi bi-pencil-square icon"></i>{{ __('Edit Fuel') }}
                                                        </a>
                                                        <div class="item" data-id="{{ $item->id }}"
                                                            id="{{ $item->delete_status == 0 ? 'restoreButton' : 'deleteButton' }}">
                                                            <i class="bi bi-trash-fill icon"></i>
                                                            {{ $item->delete_status == 0 ? __('Retore') : __('Move to Trash') }}
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
        @foreach ($fuels as $index => $supplier)
            $(".dropdown{{ $i++ }}").dropdown();
        @endforeach
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '#buttonHide', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: "{{ __('Hide Fuel') }}",
                    text: "{{ __('Are you sure you want to hide this fuel?') }}",
                    icon: "question",
                    iconHtml: "<i class='bi bi-eye-slash-fill icon'></i>",
                    confirmButtonText: "{{ __('Yes, Hide it') }}",
                    cancelButtonText: "{{ __('No, Cancel') }}",
                    showCancelButton: true,
                    showCloseButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('fuel-type-price.hide') }}",
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id
                            },
                            success: function(response) {

                                Swal.fire({
                                    title: response.message,
                                    icon: "success",
                                    draggable: true,
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            },
                            error: function(xhr) {
                                console.error(xhr);
                            }
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1200);
                    }
                });
            });

            $(document).on('click', '#buttonShow', function() {
                let id = $(this).data('id');
                Swal.fire({
                    title: "{{ __('Show Fuel') }}",
                    text: "{{ __('Are you sure you want to show this fuel?') }}",
                    icon: "question",
                    iconHtml: "<i class='bi bi-eye-fill icon'></i>",
                    confirmButtonText: "{{ __('Yes, Show it') }}",
                    cancelButtonText: "{{ __('No, Cancel') }}",
                    showCancelButton: true,
                    showCloseButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('fuel-type-price.hide') }}",
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: id
                            },
                            success: function(response) {

                                Swal.fire({
                                    title: response.message,
                                    icon: "success",
                                    draggable: true,
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                            },
                            error: function(xhr) {
                                console.error(xhr);
                            }
                        });
                        setTimeout(function() {
                            location.reload();
                        }, 1200);
                    }
                });
            });

            $(document).on('click', '#pdfButton', function() {
                $.ajax({
                    type: "get",
                    url: "{{ route('fuel-type-price.pdf') }}",
                    data: "data",
                    dataType: "json",
                    success: function(response) {

                    }
                });
            });
        });
    </script>
@endsection
