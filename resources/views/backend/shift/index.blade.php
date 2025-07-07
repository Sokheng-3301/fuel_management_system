@extends('backend.layout.master')
@section('title')
    {{ __('Shift Management') }}
@endsection
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/backend/fuel-type.css') }}"> --}}
    <style>
        /* HTML: <div class="loader"></div> */
        /* HTML: <div class="loader"></div> */
    </style>
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
                    <h3 class="card-title">{{ __('Shift Management') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                        <a href="{{ route('shift.create') }}" class="ui button small blue"><i
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
                                <a href="{{ route('shift.pdf') }}" class="ui button" id="pdfButton"><i
                                        class="bi bi-file-pdf icon"></i>{{ __('PDF') }}</a>
                                <a href="{{ route('shift.excel') }}" class="ui button" id="excelButton"><i
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
                                        <th scope="col" class="text-start">{{ __('Shift') }}</th>
                                        <th scope="col" class="text-start">{{ __('Employee') }}</th>
                                        <th scope="col" class="text-start">{{ __('Start-End (Time)') }}</th>
                                        <th scope="col" class="text-start" colspan="2">{{ __('Create Info') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($shifts as $item)
                                        <tr class="{{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                            <th scope="row"
                                                class="text-center {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                {{ $i }}</th>

                                            <td
                                                class="text text-start {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                <p>{{ $item->pump_code }}</p>
                                            </td>

                                            <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                <p>{{ $item->fuelType->fuel_type_kh }}</p>
                                                <p class="text-capitalize">{{ $item->fuelType->fuel_type_en }}</p>
                                            </td>


                                            <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                <div
                                                    class="ui small label text-start {{ $item->status == 1 ? 'green' : 'red' }}">
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



                                            <td class="text-end {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                <div
                                                    class="ui scrolling pointing icon button nimi p-1 circular dropdown dropdown{{ $i }}">
                                                    <i class="bi bi-three-dots-vertical icon"></i>
                                                    <div class="menu left">
                                                        <a href="{{ route('pump.edit', $item->id) }}" class="item"><i
                                                                class="bi bi-pencil-square icon"></i>{{ __('Edit Fuel') }}</a>
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
                                        @php
                                            $i++;
                                        @endphp
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
    @if ($shifts != null)
        <script>
            @php
                $i = 1;
            @endphp
            @foreach ($shifts as $index => $student)
                $(".ui.dropdown{{ $i++ }}").dropdown();
            @endforeach
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $(document).on('click', '#buttonHide', function() {
                let id = $(this).data('id');
                var url = "{{ route('pump.destroy', ':id') }}".replace(':id', id);
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
                var url = "{{ route('pump.destroy', ':id') }}".replace(':id', id);

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
