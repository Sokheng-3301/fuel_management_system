@extends('backend.layout.master')
@section('title')
    {{ __('Supplier') }}
@endsection
@section('css')
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
                    <h3 class="card-title">{{ __('Supplier List') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                        <a href="{{ route('supplier.create') }}" class="ui button small blue"><i
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
                                <a href="{{ route('supplier.pdf') }}" class="ui button" id="pdfButton"><i
                                        class="bi bi-file-pdf icon"></i>{{ __('PDF') }}</a>
                                <a href="{{ route('supplier.excel') }}" class="ui button" id="excelButton"><i
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
                                        <th scope="col" class="text-start">{{ __('Supplier ID') }}</th>
                                        <th scope="col" class="text-start">{{ __('Supplier Name') }}</th>
                                        <th scope="col" class="text-start">{{ __('Contact Info') }}</th>
                                        <th scope="col" class="text-start" style="width: 20%">{{ __('Address') }}</th>
                                        <th scope="col" class="text-start" colspan="2">{{ __('Create Info') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliers as $index => $item)
                                        <tr class="{{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                            <th scope="row"
                                                class="text-center {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                {{ $index + 1 }}
                                            </th>
                                            <td class="text-start {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                {{ $item->supplier_code }}
                                            </td>
                                            <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                <p>{{ $item->fullname_kh }}</p>
                                                <p class="text-capitalize">{{ $item->fullname_en }}</p>
                                            </td>
                                            <td class="text-start text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                <p>
                                                    <i
                                                        class="bi bi-envelope-at icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}"></i>
                                                    <a class="{{ $item->delete_status == 0 ? 'text-danger' : '' }}" href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                                                </p>
                                                <p>
                                                    <i
                                                        class="bi bi-telephone icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}"></i>
                                                    <a class="{{ $item->delete_status == 0 ? 'text-danger' : '' }}" href="tel:{{ $item->phone }}">{{ $item->phone }}</a>
                                                </p>
                                            </td>
                                            <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                {{ $item->address }}
                                            </td>
                                            <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                <p>{{ $item->user->fullname_kh }}</p>
                                                <p class="text-capitalize">{{ $item->user->fullname_en }}</p>
                                                <p class="{{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}">
                                                    {{ Carbon\Carbon::parse($item->updated_at)->format('d m Y - h:i:s A') }}
                                                </p>
                                            </td>
                                            <td class="text-end {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                                <div
                                                    class="ui scrolling pointing icon button nimi p-1 circular dropdown dropdown{{ $index + 1 }}">
                                                    <i class="bi bi-three-dots-vertical icon"></i>
                                                    <div class="menu left">
                                                        <a href="{{ route('supplier.edit', $item->id) }}" class="item">
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
        @foreach ($suppliers as $index => $supplier)
            $(".dropdown{{ $i++ }}").dropdown();
        @endforeach
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '#buttonHide', function() {
                let id = $(this).data('id');
                var url = "{{ route('supplier.destroy', ':id') }}".replace(':id', id);
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
                var url = "{{ route('supplier.destroy', ':id') }}".replace(':id', id);

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
        });
    </script>
@endsection
