@extends('backend.layout.master')
@section('title')
    {{ __('Pump Management') }}
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
                    <h3 class="card-title">{{ __('Pump Management') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                        <a href="{{ route('pump.create') }}" class="ui button small blue"><i
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
                                <a href="{{ route('pump.pdf') }}" class="ui button" id="pdfButton"><i class="bi bi-file-pdf icon"></i>{{ __('PDF') }}</a>
                                <a href="{{ route('pump.excel') }}" class="ui button" id="excelButton"><i
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
                                        <th scope="col" class="text-start">{{ __('S.R') }}</th>
                                        <th scope="col">{{ __('Fuel Type') }}</th>
                                        <th scope="col" class="text-start">{{ __('Fuel Price') }}</th>
                                        <th scope="col" class="text-start">{{ __('Editor Name') }}</th>
                                        <th scope="col" class="text-start" colspan="2">{{ __('Edit Date') }}</th>
                                        {{-- <th scope="col" class="text-end">{{__('Actions')}}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @foreach ($pumps as $item)
                                        <tr class="{{ $item->visibility == 0 ? 'text-danger' : '' }}">
                                            <th scope="row"
                                                class="text-center {{ $item->visibility == 0 ? 'text-danger' : '' }}">
                                                {{ $i }}</th>
                                            <td class="text {{ $item->visibility == 0 ? 'text-danger' : '' }}">
                                                <p>{{ $item->fuel_type_kh }}</p>
                                                <p class="text-capitalize">{{ $item->fuel_type_en }}</p>
                                            </td>
                                            <td class="text-start {{ $item->visibility == 0 ? 'text-danger' : '' }}"><i
                                                    class="bi bi-currency-dollar icon text-muted"></i>{{ $item->today_price }}
                                            </td>
                                            <td class="text {{ $item->visibility == 0 ? 'text-danger' : '' }}">
                                                <p>{{ $item->user->fullname_kh }}</p>
                                                <p class="text-capitalize">{{ $item->user->fullname_en }}</p>
                                            </td>
                                            <td class="{{ $item->visibility == 0 ? 'text-danger' : '' }}">
                                                {{ Carbon\Carbon::parse($item->updated_at)->format('d m Y - h:i:s A') }}
                                            </td>
                                            <td class="text-end {{ $item->visibility == 0 ? 'text-danger' : '' }}">
                                                <div
                                                    class="ui mini label text-start {{ $item->visibility == 1 ? 'green' : 'red' }}">
                                                    {{ $item->visibility == 1 ? __('Show') : __('Hidden') }}</div>
                                                <div
                                                    class="ui scrolling pointing icon button nimi p-1 circular dropdown dropdown{{ $i }}">
                                                    <i class="bi bi-three-dots-vertical icon"></i>
                                                    <div class="menu left">
                                                        <a href="{{ route('fuel-type-price.edit', $item->id) }}"
                                                            class="item"><i
                                                                class="bi bi-pencil-square icon"></i>{{ __('Edit Fuel') }}</a>
                                                        <div class="item"
                                                            id="{{ $item->visibility == 1 ? 'buttonHide' : 'buttonShow' }}"
                                                            data-id="{{ $item->id }}"><i
                                                                class="bi {{ $item->visibility == 1 ? 'bi-eye-slash-fill' : 'bi-eye-fill' }} icon"></i>{{ $item->visibility == 1 ? __('Hide Fuel') : __('Show Fuel') }}
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
    @if ($items != null)
        <script>
            @php
                $i = 1;
            @endphp
            @foreach ($items as $index => $student)
                $(".ui.dropdown{{ $i++ }}").dropdown();
            @endforeach
        </script>
    @endif
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

            $(document).on('click', '#pdfButton', function () {
                $.ajax({
                    type: "get",
                    url: "{{ route('fuel-type-price.pdf') }}",
                    data: "data",
                    dataType: "json",
                    success: function (response) {

                    }
                });
            });
        });
    </script>
@endsection
