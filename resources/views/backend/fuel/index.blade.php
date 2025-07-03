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
                                                    class="ps-2 {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}">{{ __('L') }}</span>
                                            </td>
                                            <td class="text-start {{ $item->delete_status == 0 ? 'text-danger' : '' }}"><i
                                                    class="bi bi-currency-dollar icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}"></i>{{ $item->unit_price ?? '0.00' }}
                                            <td class="text-start {{ $item->delete_status == 0 ? 'text-danger' : '' }}"><i
                                                    class="bi bi-currency-dollar icon {{ $item->delete_status == 0 ? 'text-danger' : 'text-muted' }}"></i>{{ $item->total_price ?? '0.00' }}
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
                                                        <div class="item" id="aboutModalBtn"
                                                            data-id="{{ $item->id }}"><i
                                                                class="bi bi-eye-fill icon"></i>{{ __('About Fuel') }}
                                                        </div>
                                                        <a href="{{ route('fuel.edit', $item->id) }}" class="item"><i
                                                                class="bi bi-pencil-square icon"></i>{{ __('Edit Fuel') }}
                                                        </a>
                                                        <div class="item" data-id="{{ $item->id }}"
                                                            id="{{ $item->delete_status == 0 ? 'restoreButton' : 'deleteButton' }}">
                                                            <i
                                                                class="bi {{ $item->delete_status == 0 ? 'bi-recycle' : 'bi-trash-fill' }} icon"></i>
                                                            {{ $item->delete_status == 0 ? __('Restore') : __('Move to Trash') }}
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

    {{-- Modal detail about fuel  --}}
    <!-- Modal -->
    <div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('About Fuel') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <div class="row">
                        <div class="col-4 col-sm-3 col-md-3 col-lg-3">{{ __('Fuel Code') }}</div>
                        <div class="col-1">:</div>
                        <div class="col-8 col-sm-8 col-md-7 col-lg-7" id="fuelCode"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 col-sm-3 col-md-3 col-lg-3">{{ __('Fuel Type') }}</div>
                        <div class="col-1">:</div>
                        <div class="col-8 col-sm-8 col-md-7 col-lg-7" id="fuelType"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4 col-sm-3 col-md-3 col-lg-3">{{ __('Supplier') }}</div>
                        <div class="col-1">:</div>
                        <div class="col-8 col-sm-8 col-md-7 col-lg-7" id="supplier"></div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 col-sm-3 col-md-3 col-lg-3">{{ __('Quantity') }}</div>
                        <div class="col-1">:</div>
                        <div class="col-8 col-sm-8 col-md-7 col-lg-7" id="qty"></div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 col-sm-3 col-md-3 col-lg-3">{{ __('Unit Price') }}</div>
                        <div class="col-1">:</div>
                        <div class="col-8 col-sm-8 col-md-7 col-lg-7" id="unitPrice"></div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 col-sm-3 col-md-3 col-lg-3">{{ __('Total Price') }}</div>
                        <div class="col-1">:</div>
                        <div class="col-8 col-sm-8 col-md-7 col-lg-7" id="totalPrice"></div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 col-sm-3 col-md-3 col-lg-3">{{ __('Date Listed') }}</div>
                        <div class="col-1">:</div>
                        <div class="col-8 col-sm-8 col-md-7 col-lg-7" id="dateListed"></div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 col-sm-3 col-md-3 col-lg-3">{{ __('Listed By') }}</div>
                        <div class="col-1">:</div>
                        <div class="col-8 col-sm-8 col-md-7 col-lg-7" id="listedBy"></div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <hr>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 col-sm-3 col-md-3 col-lg-3">{{ __('Deleted Date') }}</div>
                        <div class="col-1">:</div>
                        <div class="col-8 col-sm-8 col-md-7 col-lg-7" id="deleteDate"></div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-4 col-sm-3 col-md-3 col-lg-3">{{ __('Deleted By') }}</div>
                        <div class="col-1">:</div>
                        <div class="col-8 col-sm-8 col-md-7 col-lg-7" id="deleteBy"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="ui button small" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
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
        @foreach ($fuels as $index => $supplier)
            $(".dropdown{{ $i++ }}").dropdown();
        @endforeach
    </script>

    <script>
        $(document).ready(function() {
            // delete
            $(document).on('click', '#deleteButton', function() {
                let id = $(this).data('id');
                var url = "{{ route('fuel.destroy', ':id') }}".replace(':id', id);
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

            // restore
            $(document).on('click', '#restoreButton', function() {
                let id = $(this).data('id');
                var url = "{{ route('fuel.destroy', ':id') }}".replace(':id', id);

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

            // about detail
            // $('#aboutModal').modal('show');

            $(document).on('click', '#aboutModalBtn', function() {
                $('#aboutModal').modal('show');
                let id = $(this).data('id');
                var url = "{{ route('fuel.show', ':id') }}".replace(':id', id);
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        if (response.status) {
                            $('#fuelCode').text(response.fuelCode);
                            $('#fuelType').text(response.fuelType);
                            $('#supplier').text(response.supplier); // Correctly set supplier
                            $('#qty').text(response.qty);
                            $('#unitPrice').html('<i class="bi bi-currency-dollar icon"></i>' +
                                response.unitPrice);
                            $('#totalPrice').html('<i class="bi bi-currency-dollar icon"></i>' +
                                response.totalPrice);
                            $('#dateListed').text(response.createdAt);
                            $('#listedBy').text(response.createdBy);
                            // Handle delete status
                            // $('#deleteDate').text(response.deleted_date);
                            // $('#deleteBy').text(response.deletedBy);
                        } else {
                            alert(response.message); // Handle case where fuel not found
                        }
                    },
                    error: function() {
                        alert('An error occurred while fetching fuel details.');
                    }
                });
            });
        });
    </script>
@endsection
