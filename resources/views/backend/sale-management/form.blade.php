@extends('backend.layout.master')
@section('title')
    @if ($update)
        {{ __('Update Sale Management') }}
    @else
        {{ __('Add Sale Management') }}
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
                <form action="{{ $update ? route('sale.update', $item->id) : route('sale.store') }}" method="POST"
                    autocomplete="off" class="ui form">
                    @csrf
                    @if ($update)
                        @method('PUT')
                    @endif
                    <div class="card-header">
                        <h3 class="card-title">{{ $update ? __('Update Sale Management') : __('Add Sale Management') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                            </button>
                            @if ($update || session('success') || session('error'))
                                <a href="{{ route('sale.index') }}"
                                    class="ui button small">{{ __('Sale Management List') }}</a>
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
                                    <label for="customer">{{ __('Customer') }} <span class="text-danger">*</span></label>

                                    <select name="customer_id" class="ui search dropdown" id="customer">
                                        <option value="">{{ __('Select Customer') }}</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                {{ $update && $item->customer_id == $customer->id ? 'selected' : '' }}>
                                                <span class="pe-2 text-primary">{{ $customer->customer_code }}</span>
                                                @if (session()->has('localization') && session('localization') == 'en')
                                                    <span class="text-capitalize">{{ $customer->fullname_en }}</span>
                                                @else
                                                    {{ $customer->fullname_kh }}
                                                @endif
                                                ({{ $customer->phone }})
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('customer_id')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="vichle_number">{{ __('Vichle Number') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="ui input">
                                        <input type="text" id="vichle_number" name="vichle_number"
                                            value="{{ $update ? $item->vichle_number : old('vichle_number') }}"
                                            placeholder="{{ __('Vichle Number') }}">
                                    </div>
                                    @error('vichle_number')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="datepicker">{{ __('Date') }} <span class="text-danger">*</span></label>
                                    <div class="ui input icon">
                                        <input type="text" id="datepicker" name="sale_date"
                                            placeholder="{{ __('mm/dd/yy') }}"
                                            value="{{ $update ? $item->sale_date : old('sale_date') }}">
                                        <i class="bi bi-calendar3 icon"></i>
                                    </div>
                                    @error('sale_date')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="fuel_type_id">{{ __('Fuel Type') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="fuel_type_id" class="ui search dropdown1" id="fuel_type_id">
                                        <option value="">{{ __('Select Fuel Type') }}</option>
                                        @foreach ($fuel_types as $fuel_type)
                                            <option value="{{ $fuel_type->id }}"
                                                {{ $update && $item->fuel_type_id == $fuel_type->id ? 'selected' : '' }}>

                                                {{ $fuel_type->fuel_type_kh }} -
                                                <span class="text-capitalize">{{ $fuel_type->fuel_type_en }}</span>
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('fuel_type_id')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 field">

                                <div class="two fields">
                                    <div class="field">
                                        <label for="qty">{{ __('Quantity') }} <span
                                                class="text-danger">*</span></label>
                                        <div class="ui input labeled">
                                            <label for="qty" class="ui label">{{ __('L') }}</label>
                                            <input type="number" min="0" step="0.001" id="qty"
                                                name="quantity" class="ui input"
                                                value="{{ $update ? $item->quantity : old('quantity') }}"
                                                placeholder="{{ __('Quantity') }}">
                                        </div>
                                        @error('quantity')
                                            <div class="ui pointing red basic label">{{ __($message) }}</div>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <label for="unit_price">{{ __('Unit Price') }} <span
                                                class="text-danger">*</span></label>
                                        <div class="ui input labeled">
                                            <label for="unit_price" class="ui label">
                                                <i class="bi bi-currency-dollar"></i>
                                            </label>
                                            <input type="number" min="0" step="0.0001" id="unit_price"
                                                name="unit_price" class="ui input"
                                                value="{{ $update ? $item->unit_price : old('unit_price') }}"
                                                placeholder="{{ __('Unit Price') }}">
                                        </div>
                                        @error('unit_price')
                                            <div class="ui pointing red basic label">{{ __($message) }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="two fields">
                                    <div class="field">
                                        <label for="discount">{{ __('Discount') }} <span
                                                class="text-danger">*</span></label>
                                        <div class="ui input labeled">
                                            <label for="discount" class="ui label">
                                                <i class="bi bi-percent"></i>
                                            </label>
                                            <input type="number" step="0.0001" value="0" min="0"
                                                id="discount" name="discount" class="ui input"
                                                value="{{ $update ? $item->discount : old('discount') }}"
                                                placeholder="{{ __('Discount') }}">
                                        </div>
                                        @error('discount')
                                            <div class="ui pointing red basic label">{{ __($message) }}</div>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <label for="total_price">{{ __('Total Price') }}</label>
                                        <div class="ui input labeled">
                                            <label for="total_price" class="ui label">
                                                <i class="bi bi-currency-dollar"></i>
                                            </label>
                                            <input type="number" readonly min="0" step="0.0001"
                                                id="total_price" name="total_price" class="ui input bg-light text-danger"
                                                value="{{ $update ? $item->total_price : old('total_price') }}"
                                                placeholder="{{ __('Total Price') }}">
                                        </div>
                                        @error('total_price')
                                            <div class="ui pointing red basic label">{{ __($message) }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="payment_method">{{ __('Payment Method') }} <span
                                            class="text-danger">*</span></label>
                                    <select name="payment_method" class="ui search dropdown2" id="payment_method">
                                        <option value="">{{ __('Select Payment Method') }}</option>

                                        {{-- @foreach (\App\Http\Helpers\AppHelper::getAllPaymentMethods() as $method)
                                            <option value="{{ $method->id }}"
                                                {{ $update && $item->payment_method == $method->id ? 'selected' : '' }}>
                                                {{ __($method->name) }}
                                            </option>
                                        @endforeach --}}



                                        <option value="1"><i class="bi bi-cash-coin icon"></i>{{__('Cash')}}</option>
                                        <option value="2"><i class="bi bi-credit-card icon"></i>{{__('Credit/Debit Cards')}}</option>
                                        <option value="3"><i class="bi bi-phone icon"></i>{{__('Mobile Payments')}}</option>
                                        <option value="4"><i class="bi bi-bank icon"></i>{{__('Bank Transfers')}}</option>


                                    </select>
                                    @error('payment_method')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
                                </div>

                                <div class="grouped fields">
                                    <label>{{__('Status')}} <small class="fw-normal text-muted ps-2">{{__('Checking -> Completed, Uncheck -> Pendding')}}</small></label>
                                    <div class="field">
                                        <div class="ui toggle checkbox">
                                            <input type="checkbox" name="status" checked="checked" id="completed"
                                                value="1" {{ $update && $item->status == 1 ? 'checked' : '' }}>
                                            <label for="completed">{{ __('Completed') }}</label>
                                        </div>
                                    </div>
                                    {{-- <div class="field">
                                        <div class="ui slider checkbox">
                                            <input type="radio" name="status" id="pending"
                                                value="0" {{ $update && $item->status == 0 ? 'checked' : '' }}>
                                            <label for="pending">{{ __('Pendding') }}</label>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>

                            <div class="col-md-12 field">
                                <div class="field">
                                    <label for="other">{{ __('Other') }}</label>
                                    <div class="ui input">
                                        <textarea name="note" id="other" rows="5" placeholder="{{ __('Other') }}...">{{ $update ? $item->note : old('note') }}</textarea>
                                    </div>
                                    @error('note')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
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
                    customer_id: {
                        identifier: 'customer_id',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please select Customer') }}"
                        }]
                    },
                    fuel_type_id: {
                        identifier: 'fuel_type_id',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please select Fuel Type') }}"
                        }]
                    },
                    vichle_number: {
                        identifier: 'vichle_number',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter Vichle Number') }}"
                        }]
                    },
                    sale_date: {
                        identifier: 'sale_date',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter Date') }}"
                        }]
                    },
                    quantity: {
                        identifier: 'quantity',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter Quantity (Litre)') }}"
                        }]
                    },

                    unit_price: {
                        identifier: 'unit_price',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter Unit Price ($)') }}"
                        }]
                    },
                    discount: {
                        identifier: 'discount',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter Discount (%)') }}"
                        }]
                    },
                    total_price: {
                        identifier: 'total_price',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter Total Price ($)') }}"
                        }]
                    },
                    payment_method: {
                        identifier: 'payment_method',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please select Payment Method') }}"
                        }]
                    },
                }
            });

        $(document).ready(function() {
            // Initialize datepicker
            // $('#datePicker').datepicker({
            //     dateFormat: 'mm/dd/yy',
            //     changeMonth: true,
            //     changeYear: true,
            //     yearRange: '1900:+10',
            //     showAnim: 'slideDown'
            // });

            // Calculate total price on quantity or unit price change
            $('#qty, #unit_price, #discount').on('input', function() {
                let qty = parseFloat($('#qty').val()) || 0;
                let unitPrice = parseFloat($('#unit_price').val()) || 0;
                let discount = parseFloat($('#discount').val()) || 0;

                let subtotal = qty * unitPrice;
                let discountAmount = subtotal * (discount / 100);
                let totalPrice = subtotal - discountAmount;
                $('#total_price').val(totalPrice.toFixed(2));
            });
        });
    </script>
@endsection
