@extends('backend.layout.master')
@section('title')
    @if ($update)
        {{ __('Update Supplier') }}
    @else
        {{ __('Add Supplier') }}
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
                <form action="{{ $update ? route('supplier.update', $item->id) : route('supplier.store') }}" method="POST"
                    autocomplete="off" class="ui form">
                    @csrf
                    @if ($update)
                        @method('PUT')
                    @endif
                    <div class="card-header">
                        <h3 class="card-title">{{ $update ? __('Update Supplier') : __('Add Supplier') }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                                <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                            </button>
                            @if ($update)
                                <a href="{{ route('supplier.index') }}"
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
                                    <label for="supplierNameKh">{{ __('Supplier Name (Khmer)') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="ui input">
                                        <input type="text" id="supplierNameKh" name="fullname_kh" class="ui input"
                                            value="{{ $update ? $item->fullname_kh : old('fullname_kh') }}" autofocus
                                            placeholder="{{ __('Supplier Name (Khmer)') }}">
                                    </div>
                                    @error('fullname_kh')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="supplierNameEn">{{ __('Supplier Name (English)') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="ui input">
                                        <input type="text" id="supplierNameEn" name="fullname_en"
                                            value="{{ $update ? $item->fullname_en : old('fullname_en') }}"
                                            placeholder="{{ __('Supplier Name (English)') }}">
                                    </div>
                                    @error('fullname_en')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 field">
                                <div class="field">
                                    <label for="emailAddress">{{ __('Email Address') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="ui input labeled">
                                        <label for="emailAddress" class="ui label"><i
                                                class="bi bi-envelope-at-fill"></i></label>
                                        <input type="email" id="emailAddress" name="email" class="ui input"
                                            value="{{ $update ? $item->email : old('email') }}" autofocus
                                            placeholder="{{ __('Email Address') }}">
                                    </div>
                                    @error('email')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="phoneNumber">{{ __('Contact Number') }} <span
                                            class="text-danger">*</span></label>
                                    <div class="ui input labeled">
                                        <label for="phoneNumber" class="ui label"><i
                                                class="bi bi-telephone-fill"></i></label>
                                        <input type="tel" id="phoneNumber" name="phone"
                                            value="{{ $update ? $item->phone : old('phone') }}"
                                            placeholder="{{ __('Contact Number') }}">
                                    </div>
                                    @error('phone')
                                        <div class="ui pointing red basic label">{{ __($message) }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 field">
                                <div class="field">
                                    <label for="address">{{ __('Address') }} <span class="text-danger">*</span></label>
                                    <div class="ui input">
                                        <textarea name="address" id="address" rows="5" placeholder="{{ __('Address') }}...">{{ $update ? $item->address : old('address') }}</textarea>
                                    </div>
                                    @error('address')
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
                    fullname_kh: {
                        identifier: 'fullname_kh',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter Supplier Name (Khmer)') }}"
                        }]
                    },
                    fullname_en: {
                        identifier: 'fullname_en',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter Supplier Name (English)') }}"
                        }]
                    },

                    email: {
                        identifier: 'email',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter Email Adress') }}"
                        }]
                    },
                    phone: {
                        identifier: 'phone',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter Contact Number') }}"
                        }]
                    },

                    address: {
                        identifier: 'address',
                        rules: [{
                            type: 'empty',
                            prompt: "{{ __('Please enter Address') }}"
                        }]
                    },
                }
            });
    </script>
@endsection
