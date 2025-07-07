@extends('backend.layout.master')
@section('title')
    @if ($update)
        {{ __('Update Shift Management') }}
    @else
        {{ __('Add Shift Management') }}
    @endif
@endsection
@section('content')
    <!--begin::Row-->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 connectedSortable">
            <!-- /.card -->
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary mb-4">
                <form action="{{ $update ? route('shift.update', $item->id) : route('shift.store') }}" method="POST"
                    autocomplete="off" class="ui form">
                    @csrf
                    @if ($update)
                        @method('PUT')
                    @endif
                    <div class="card-header">
                        <h3 class="card-title">{{ $update ? __('Update Shift Management') : __('Add Shift Management') }}
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                            </button>

                            @if ($update || session('success') || session('error'))
                                <a href="{{ route('shift.index', @$queryString) }}"
                                    class="ui button small">{{ __('Shift Management List') }}</a>
                            @else
                                <button type="reset" class="ui button small">{{ __('Reset') }}</button>
                            @endif

                            <button type="submit" class="ui button small {{ $update ? 'teal' : 'blue' }}"><i
                                    class="bi {{ $update ? 'bi-pencil-square' : 'bi-bookmark-check-fill' }} icon"></i>
                                {{ $update ? __('Update') : __('Save') }}
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-6 field">
                                <div class="field">
                                    <label for="shift_id">{{ __('Shift') }} <span class="text-danger">*</span></label>
                                    <select name="shift_id" id="shift_id" class="ui search dropdown">
                                        <option value="">{{ __('Select Shift') }}</option>
                                        @foreach ($shift_selects as $shift)
                                            <option value="{{ $shift->id }}"
                                                @if ($update) {{ $item->shift_id == $shift->id ? 'selected' : '' }}
                                                @else {{ old('shift_id') == $shift->id ? 'selected' : '' }} @endif>
                                                {{ $shift->shift_kh }} -
                                                <span class="text-capitalize">{{ $shift->shift_en }}</span>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 field">
                                <div class="field">
                                    <label for="employee_id">{{ __('Employee') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="employee_id" id="employee_id" class="ui search dropdown1">
                                        <option value="">{{ __('Select Employee') }}</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                @if ($update) {{ $item->employee_id == $employee->id ? 'selected' : '' }}
                                                @else {{ old('employee_id') == $employee->id ? 'selected' : '' }} @endif>
                                                {{ $employee->id_card ?? '000000 '. $employee->fullname_kh }} -
                                                <span class="text-capitalize">{{ $employee->fullname_en }}</span>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-6 field">
                                <div class="field">
                                    <label for="start_time">{{ __('Start Time') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="start_time" name="start_time"
                                        placeholder="{{ __('Start Time') }}">
                                </div>
                            </div>
                            <div class="col-md-6 field">
                                <div class="field">
                                    <label for="end_time">{{ __('End Time') }} <span class="text-danger">*</span></label>
                                    <input type="text" id="end_time" name="end_time"
                                        placeholder="{{ __('End Time') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="field">
                                    <div class="ui toggle checkbox">
                                        <input type="checkbox" name="status" id="status"
                                            @if ($update) {{ $item->status == 1 ? 'checked' : '' }}
                                            @elseif (old('status') == 1) checked
                                        @else
                                            checked @endif
                                            value="1">
                                        <label for="status" class="fw-bold">{{ __('Active') }}</label>
                                    </div>
                                </div>
                                <div class="ui error message"></div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.direct-chat -->
        </div>
    </div>

    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 connectedSortable">
            <!-- /.card -->
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary mb-4">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Shift List') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                        <button data-bs-toggle="modal" data-bs-target="#modalShiftForm" class="ui button small black"><i
                                class="bi bi-plus-circle-fill icon"></i>
                            {{ __('Add new shift') }}
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-3">
                    <div class="myresponsive">
                        <div class="bg-table-loader">
                            <div class="loader"></div>
                        </div>
                        <table class="table table-hover" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-start">{{ __('No.') }}</th>
                                    <th scope="col" class="text-start">{{ __('Shift') }}</th>
                                    <th scope="col" class="text-start text-end">{{ __('Create Info') }}</th>
                                    <th scope="col" class="text-start text-end">&nbsp;</th>
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
                                            {{ $i }}
                                        </th>

                                        <td class="text {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
                                            <p>{{ $item->shift_kh }}</p>
                                            <p class="text-capitalize">{{ $item->shift_en }}</p>
                                        </td>

                                        <td class="text text-end {{ $item->delete_status == 0 ? 'text-danger' : '' }}">
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
                                                    <a type="button" id="shiftButtonEdit" data-id="{{ $item->id }}"
                                                        class="item"><i
                                                            class="bi bi-pencil-square icon"></i>{{ __('Edit Shift') }}</a>
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
                <!-- /.card-body -->
            </div>
            <!-- /.direct-chat -->
        </div>
    </div>
    <!-- /.row (main row) -->

    {{-- modal Update shift  --}}
    <!-- Modal -->
    <div class="modal fade" id="modalShiftFormUpdate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="" class="ui form" method="POST" id="formShiftUpdate" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalShiftFormUpdateLabel">{{ __('Edit Shift') }}</h1>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="field">
                                    <label for="shift_kh_update">{{ __('Shift name (Kh)') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="shift_kh_update" id="shift_kh_update"
                                        placeholder="{{ __('Shift name (Kh)') }}" value="{{ old('shift_kh_update') }}">
                                    @error('shift_kh_update')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label for="shift_en_update">{{ __('Shift name (En)') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="shift_en_update" name="shift_en_update"
                                        placeholder="{{ __('Shift name (En)') }}" value="{{ old('shift_en_update') }}">
                                    @error('shift_en_update')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
                                </div>

                                <div class="field">
                                    <div class="ui toggle checkbox">
                                        <input type="checkbox" name="delete_status" id="delete_status_update"
                                            {{ old('delete_status') == 1 ? 'checked' : '' }} value="1">
                                        <label for="delete_status_update" class="fw-bold">{{ __('Active') }}</label>
                                    </div>
                                </div>
                                <div class="ui message error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="ui button small "
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        {{-- <button type="button" class="ui button small primary"> {{__('Save')}}</button> --}}
                        <button type="submit" class="ui button small teal">
                            {{ __('Update') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal add shift  --}}
    <!-- Modal -->
    <div class="modal fade" id="modalShiftForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{ route('shift-select.store') }}" class="ui form" method="POST" id="formShift"
                    autocomplete="off">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalShiftFormLabel">{{ __('Add new shift') }}</h1>
                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="field">
                                    <label for="shift_kh">{{ __('Shift name (Kh)') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="shift_kh" id="shift_kh" class="shift_kh"
                                        placeholder="{{ __('Shift name (Kh)') }}" value="{{ old('shift_kh') }}">
                                    @error('shift_kh')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label for="shift_en">{{ __('Shift name (En)') }} <span
                                            class="text-danger">*</span></label>
                                    <input type="text" id="shift_en" name="shift_en" class="shift_en"
                                        placeholder="{{ __('Shift name (En)') }}" value="{{ old('shift_en') }}">
                                    @error('shift_en')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
                                </div>

                                <div class="field">
                                    <div class="ui toggle checkbox">
                                        <input type="checkbox" name="delete_status" id="delete_status"
                                            {{ old('delete_status') == 1 ? 'checked' : 'checked' }} value="1">
                                        <label for="delete_status" class="fw-bold">{{ __('Active') }}</label>
                                    </div>
                                </div>
                                <div class="ui message error"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="ui button small "
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        {{-- <button type="button" class="ui button small primary"> {{__('Save')}}</button> --}}
                        <button type="submit" class="ui button small black">
                            {{ __('Save') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
        $('.ui.form')
            .form({
                fields: {
                    pump_code: {
                        identifier: 'pump_code',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter pump code') }}"
                        }]
                    },
                    fuel_type_id: {
                        identifier: 'fuel_type_id',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please select Fuel Type') }}"
                        }]
                    },
                }
            });
        $(document).ready(function() {
            $('#start_time').mdtimepicker();
            $('#end_time').mdtimepicker();


            @if ($errors->has('shift_en') || $errors->has('shift_kh') || session()->has('show_form'))
                $('#modalShiftForm').modal('show');
            @endif

            $('#formShift')
                .form({
                    fields: {
                        shift_kh: {
                            identifier: 'shift_kh',
                            rules: [{
                                type: 'empty',
                                prompt: "{{ __('Please enter shift name (Kh)') }}"
                            }]
                        },
                        shift_en: {
                            identifier: 'shift_en',
                            rules: [{
                                type: 'empty',
                                prompt: "{{ __('Please enter shift name (En)') }}"
                            }]
                        },
                    }
                });

            // update Shift​ start
                $(document).on('click', '#shiftButtonEdit', function() {
                    let id = $(this).data('id');
                    var url = "{{ route('shift-select.edit', ':id') }}".replace(':id', id);
                    let button = $(this); // Store the button reference

                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            var action = "{{ route('shift-select.update', ':id') }}".replace(':id',
                                response.shift_select.id);

                            $('#modalShiftFormUpdate').modal('show');
                            $('#shift_kh_update').val(response.shift_select.shift_kh);
                            $('#shift_en_update').val(response.shift_select.shift_en);
                            $('#delete_status_update').prop('checked', response.shift_select
                                .delete_status == 1);
                            $('#formShiftUpdate').attr('action', action);
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

                @if ($errors->has('shift_kh_update') || $errors->has('shift_en_update') || session()->has('show_form_update'))
                    $('#modalShiftFormUpdate').modal('show');
                @endif

                $('#formShiftUpdate')
                .form({
                    fields: {
                        shift_kh_update: {
                            identifier: 'shift_kh_update',
                            rules: [{
                                type: 'empty',
                                prompt: "{{ __('Please enter shift name (Kh)') }}"
                            }]
                        },
                        shift_en_update: {
                            identifier: 'shift_en_update',
                            rules: [{
                                type: 'empty',
                                prompt: "{{ __('Please enter shift name (En)') }}"
                            }]
                        },
                    }
                });
            // update Shift​ end


            // remove shift select to trash
                $(document).on('click', '#buttonHide', function() {
                    let id = $(this).data('id');
                    var url = "{{ route('shift-select.destroy', ':id') }}".replace(':id', id);
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
                    var url = "{{ route('shift-select.destroy', ':id') }}".replace(':id', id);

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
            // remove shift select to trash

        });
    </script>
@endsection
