@extends('backend.layout.master')
@section('title')
    @if ($update)
        {{ __('Update Pump Management') }}
    @else
        {{ __('Add Pump Management') }}
    @endif
@endsection
@section('content')
    <!--begin::Row-->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-7 connectedSortable">
            <!-- /.card -->
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary mb-4">
                <form action="{{ $update ? route('pump.update', $item->id) : route('pump.store') }}" method="POST"
                    autocomplete="off" class="ui form">
                    @csrf
                    @if ($update)
                        @method('PUT')
                    @endif
                    <div class="card-header">
                        <h3 class="card-title">{{ $update ? __('Update Pump Management') : __('Add Pump Management') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                            </button>

                            @if ($update || session('success') || session('error'))
                                <a href="{{ route('pump.index', @$queryString) }}"
                                    class="ui button small">{{ __('Pump Management List') }}</a>
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
                            <div class="col-md-12 field">
                                <div class="field">
                                    <label for="pump_code">{{ __('Pump Code') }} <span class="text-danger">*</span></label>
                                    <div class="ui input">
                                        <input type="text" id="pump_code" name="pump_code" class="ui input"
                                            value="{{ $update ? $item->pump_code : old('pump_code') }}" autofocus
                                            placeholder="{{ __('Pump Code') }}">
                                    </div>
                                    @error('pump_code')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
                                </div>


                                <div class="field">
                                    <label for="fuel_type_id">{{ __('Fuel Type') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="fuel_type_id" id="fuel_type_id" class="ui search dropdown">
                                        <option value="">{{ __('Select Fuel Type') }}</option>
                                        @foreach ($fuel_types as $fuel_type)
                                            <option value="{{ $fuel_type->id }}"
                                                @if ($update) {{ $item->fuel_type_id == $fuel_type->id ? 'selected' : '' }}
                                                @else {{ old('fuel_type_id') == $fuel_type->id ? 'selected' : '' }} @endif>
                                                {{ $fuel_type->fuel_type_kh }} -
                                                <span class="text-capitalize">{{ $fuel_type->fuel_type_en }}</span>
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

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
    <!-- /.row (main row) -->
@endsection

@section('js')
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
    </script>
@endsection
