@extends('backend.layout.master')
@section('title')
    @if ($update)
        {{ __('Update Todays Fuel Price') }}
    @else
        {{ __('Add Todays Fuel Price') }}
    @endif
@endsection
@section('content')
    <!--begin::Row-->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-6 connectedSortable">
            <!-- /.card -->
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary mb-4">
                <form action="{{ $update ? route('fuel-type-price.update', $fuel->id) : route('fuel-type-price.store') }}"
                    method="POST" autocomplete="off" class="ui form">
                    @csrf
                    @if ($update)
                        @method('PUT')
                    @endif
                    <div class="card-header">
                        <h3 class="card-title">{{ $update ? __('Update Todays Fuel Price') : __('Add Todays Fuel Price') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                            </button>
                            <button type="reset" class="ui button small">{{ __('Reset') }}</button>
                            <button type="submit"
                                class="ui button small {{ $update ? 'teal' : 'blue' }}"><i
                                    class="bi {{ $update ? 'bi-pencil-square' : 'bi-bookmark-check-fill' }} icon"></i>
                                    {{ $update ? __('Update') : __("Save") }}
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-12 field">
                                <div class="field">
                                    <label for="fuelTypeKh">{{ __('Fuel Type (Khmer)') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="ui input @error('fuel_type_kh') error @enderror">
                                        <input type="text" id="fuelTypeKh" name="fuel_type_kh" class="ui input"
                                            value="{{ $update ? $fuel->fuel_type_kh : old('fuel_type_kh') }}" autofocus
                                            placeholder="{{ __('Fuel Type (Khmer)') }}">
                                    </div>
                                    @error('fuel_type_kh')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="fuelTypeEn">{{ __('Fuel Type (English)') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="ui input @error('fuel_type_en') error @enderror">
                                        <input type="text" id="fuelTypeEn" name="fuel_type_en"
                                            value="{{ $update ? $fuel->fuel_type_en : old('fuel_type_en') }}"
                                            placeholder="{{ __('Fuel Type (English)') }}">
                                    </div>
                                    @error('fuel_type_en')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="todayPrice">{{ __('Fuel Price') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="ui labeled input">
                                        <label for="todayPrice" class="ui label"><i
                                                class="bi bi-currency-dollar icon"></i></label>
                                        <input type="number" step="0.01" name="today_price" id="todayPrice"
                                            placeholder="{{ __('Fuel Price') }}"
                                            value="{{ $update ? $fuel->today_price : old('today_price') }}">
                                    </div>
                                </div>

                                <div class="field">
                                    <div class="ui toggle checkbox">
                                        <input type="checkbox" name="public" id="public"
                                            @if ($update) {{ $fuel->visibility == 1 ? 'checked' : '' }}
                                        @else
                                            checked @endif
                                            value="1">
                                        <label for="public" class="fw-bold">{{ __('Show as public') }}</label>
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
                    fuel_type_kh: {
                        identifier: 'fuel_type_kh',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter Fuel Type (Khmer)') }}"
                        }]
                    },
                    fuel_type_en: {
                        identifier: 'fuel_type_en',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter Fuel Type (English)') }}"
                        }]
                    },

                    today_price: {
                        identifier: 'today_price',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter Fuel Price ($)') }}"
                        }]
                    },
                }
            });
    </script>
@endsection
