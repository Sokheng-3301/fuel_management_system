@extends('backend.layout.master')
@section('title')
    {{ $update ? __('Update Fuel Inventory') : __('Add Fuel Inventory') }}
@endsection
@section('content')
    <!--begin::Row-->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 connectedSortable">
            <!-- /.card -->
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary mb-4">
                <form action="{{ $update ? route('fuel.update', $fuel->id) : route('fuel.store') }}" method="POST"
                    autocomplete="off" class="ui form">
                    @csrf
                    @if ($update)
                        @method('PUT')
                    @endif
                    <div class="card-header">
                        <h3 class="card-title">{{ $update ? __('Update Fuel Inventory') : __('Add Fuel Inventory') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                            </button>
                            @if ($update)
                                <a href="{{ route('fuel.index') }}"
                                    class="ui button small">{{ __('Supplier List') }}</a>
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
                                    <label for="fuelType">{{ __('Fuel Type') }} <span class="text-danger">*</span></label>
                                    <select name="fuel_type_id" class="ui dropdown" autofocus id="fuelType">
                                        <option value="">{{ __('Select fuel type') }}</option>
                                        @foreach ($fuelTypes as $fuelType)
                                            <option
                                                @if ($update) {{ $fuelType->id == $fuel->fuel_type_id ? 'selected' : '' }}
                                                @else
                                                {{ old('fuel_type_id' == $fuelType->id) ? 'selected' : '' }} @endif
                                                value="{{ $fuelType->id }}">{{ $fuelType->fuel_type_kh }}
                                                ({{ $fuelType->fuel_type_en }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="field">
                                    <label for="supplier_id">{{ __('Supplier') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="supplier_id" id="supplier_id" class="ui dropdown1">
                                        <option value="">{{ __('Select supplier') }}</option>
                                        @foreach ($suppliers as $supplier)
                                            <option
                                                @if ($update) {{ $supplier->id == $fuel->supplier_id ? 'selected' : '' }}
                                                @else
                                                {{ old('supplier_id' == $supplier->id) ? 'selected' : '' }} @endif
                                                value="{{ $supplier->id }}"><span
                                                    class="text-primary">{{ $supplier->supplier_code }} </span>
                                                {{ $supplier->fullname_kh }}
                                                ({{ $supplier->fullname_en }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 field">
                                <div class="field">
                                    <label for="qty">{{ __('Quantity') }} <span class="text-danger">*</span></label>
                                    <div class="ui labeled input">
                                        <label for="qty" class="ui label">{{ __('L') }}</label>
                                        <input type="number" min="0" step="0.0001" name="qty" id="qty"
                                            value="{{ $update ? $fuel->qty : old('qty') }}"
                                            placeholder="{{ __('Quantity') }}">
                                    </div>
                                </div>

                                <div class="two fields">
                                    <div class="field">
                                        <label for="total_price">{{ __('Unit Price') }} <span
                                                class="text-danger">*</span></label>
                                        <div class="ui labeled input">
                                            <label for="unit_price" class="ui label"><i
                                                    class="bi bi-currency-dollar icon"></i></label>
                                            <input type="number" min="0" step="0.0001" name="unit_price"
                                                value="{{ $update ? $fuel->unit_price : old('unit_price') }}"
                                                id="unit_price" placeholder="{{ __('Unit Price') }}">
                                        </div>
                                    </div>

                                    <div class="field">
                                        <label for="total_price">{{ __('Total Price') }}</label>
                                        <div class="ui labeled input">
                                            <label for="total_price" class="ui label"><i
                                                    class="bi bi-currency-dollar icon"></i></label>
                                            <input type="text" name="total_price" readonly class="bg-light"
                                                value="{{ $update ? $fuel->total_price : old('total_price') }}"
                                                id="total_price" placeholder="{{ __('0.00') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 field">
                                <div class="field">
                                    <label for="fuel_specification">{{ __('Fuel Specification') }}</label>
                                    <textarea name="fuel_specification" id="fuel_specification" cols="30" rows="6"
                                        placeholder="{{ __('Fuel Specification') }}...">{{ $update ? $fuel->fuel_specification : old('fuel_specification') }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6 field">
                                <div class="field">
                                    <label for="note">{{ __('Other') }}</label>
                                    <textarea name="note" id="note" cols="30" rows="6" placeholder="{{ __('Other') }}...">{{ $update ? $fuel->note : old('note') }}</textarea>
                                </div>
                            </div>

                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="ui message error"></div>
                                @if ($errors->any())
                                    <div class="ui error message">
                                        <i class="close icon"></i>
                                        <div class="header">{{ __('Error') }}</div>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
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
                    fuel_type_id: {
                        identifier: 'fuel_type_id',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please select Fuel Type') }}"
                        }]
                    },
                    supplier_id: {
                        identifier: 'supplier_id',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please select Supplier') }}"
                        }]
                    },

                    qty: {
                        identifier: 'qty',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter Quantity (Liter)') }}"
                        }]
                    },
                    unit_price: {
                        identifier: 'unit_price',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter Unit Price') }}"
                        }]
                    },
                    total_price: {
                        identifier: 'total_price',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Total Price are not empty') }}"

                        }]
                    },
                }
            });

        $(document).ready(function() {
            var decimalPlaces = 2; // Set the number of decimal places
            $(document).on('input', '#unit_price', function() {
                var qty = parseFloat($('#qty').val()) || 0;
                var unitPrice = parseFloat($(this).val()) || 0;
                var totalPrice = qty * unitPrice;

                $('#total_price').val(totalPrice.toFixed(
                    decimalPlaces)); // Set total price with 4 decimal places
            });
            $(document).on('input', '#qty', function() {
                var qty = parseFloat($(this).val()) || 0;
                var unitPrice = parseFloat($('#unit_price').val()) || 0;
                var totalPrice = qty * unitPrice;

                $('#total_price').val(totalPrice.toFixed(
                    decimalPlaces)); // Set total price with 4 decimal places
            });
        });
        // $(document).ready(function () {
        //     $('nav ul li a').removeClass('active'); // Remove 'active' class from all links
        //     $('#fuelInventory .main-link').addClass('active'); // Add 'menu-open' class to #fuelInventory
        //     $('#fuelInventory').addClass('menu-open'); // Add 'menu-open' class to #fuelInventory
        //     $('#fuelInventory .addNew a').addClass('active'); // Add 'active' class to .manage under #fuelInventory
        // });
    </script>
@endsection
