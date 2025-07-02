@extends('backend.layout.master')
@section('title')
    {{ __('Add Fuel Inventory') }}
@endsection
@section('content')
    <!--begin::Row-->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 connectedSortable">
            <!-- /.card -->
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary mb-4">
                <form action="{{ route('fuel.store') }}" method="POST" autocomplete="off" class="ui form">
                    @csrf
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Add Fuel Inventory') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                            </button>
                            <button type="reset" class="ui button small">{{ __('Reset') }}</button>
                            <button type="submit" class="ui button small blue"><i class="bi bi-bookmark-check-fill icon"></i>{{ __('Save') }}</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-6 field">
                                <div class="field">
                                    <label for="fuelType">{{__("Fuel Type")}} <span class="text-danger">*</span></label>
                                    <select name="fuel_type_id" id="fuelType" class="ui dropdown" autofocus>
                                        <option value="">{{__("Select fuel type")}}</option>
                                        <option value="1">Type1</option>
                                    </select>
                                </div>

                                <div class="field">
                                    <label for="supplier_id">{{__("Supplier")}} <span class="text-danger">*</span></label>
                                    <select name="supplier_id" id="supplier_id" class="ui dropdown1">
                                        <option value="">{{__("Select supplier")}}</option>
                                        <option value="1">Supplier 1</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 field">
                                <div class="field">
                                    <label for="qty">{{__("Quantity")}} <span class="text-danger">*</span></label>
                                    <div class="ui labeled input">
                                        <label for="qty" class="ui label">{{__('L')}}</label>
                                        <input type="number" min="0" name="qty" id="qty" placeholder="{{ __('Quantity') }}">
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="total_price">{{__("Purchase Price")}} <span class="text-danger">*</span></label>
                                    <div class="ui labeled input">
                                        <label for="total_price" class="ui label"><i class="bi bi-currency-dollar icon"></i></label>
                                        <input type="number" min="0" name="total_price" id="total_price" placeholder="{{ __('Purchase Price') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6 field">
                                <div class="field">
                                    <label for="fuel_specification">{{ __('Fuel Specification') }}</label>
                                    <textarea name="fuel_specification" id="fuel_specification" cols="30" rows="6" placeholder="{{ __('Fuel Specification') }}..."></textarea>
                                </div>
                            </div>

                            <div class="col-md-6 field">
                                <div class="field">
                                    <label for="note">{{ __('Other') }}</label>
                                    <textarea name="note" id="note" cols="30" rows="6" placeholder="{{ __('Other') }}..."></textarea>
                                </div>
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
        // $(document).ready(function () {
        //     $('nav ul li a').removeClass('active'); // Remove 'active' class from all links
        //     $('#fuelInventory .main-link').addClass('active'); // Add 'menu-open' class to #fuelInventory
        //     $('#fuelInventory').addClass('menu-open'); // Add 'menu-open' class to #fuelInventory
        //     $('#fuelInventory .addNew a').addClass('active'); // Add 'active' class to .manage under #fuelInventory
        // });
    </script>
@endsection
