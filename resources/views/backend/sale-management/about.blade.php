@extends('backend.layout.master')
@section('title')
    {{ __('About Sale Management') }}
@endsection
@section('css')
    <style>
        .makeDone {
            transition: all 0.2s;
            color: #2185d0;
            text-decoration: underline;
        }

        .makeDone:hover {
            color: #29a2ff;
        }
    </style>
@endsection
@section('content')
    <!--begin::Row-->
    <div class="row">
        {{-- Detail section  --}}
        <div class="col-lg-6 connectedSortable">
            <!-- /.card -->
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-primary mb-4">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Sale Management detail info') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                        <a href="{{ route('sale.index', $queryString) }}" class="ui button mini grey"><i
                                class="bi bi-list-ul icon"></i>{{ __('List') }}</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-3">
                    <div class="bg-table-loader">
                        <div class="loader"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            {{-- ---------- About Employee -------- --}}
                            <h5 class="ui header"><i class="bi bi-person-badge"></i> {{ __('About Employee') }}</h5>
                            <div class="row">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('ID Card') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">{{ $item->user->id_card ?? 'ID-00001' }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('Fullname') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">{{ $item->user->fullname_kh }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4"></div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">{{ $item->user->fullname_en }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('Gender') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">
                                    {{ $item->user->gender == 'm' ? __('Male') : __('Female') }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('Position') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">{{ $item->user->position_id }}</div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('Sale Date') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">
                                    {{ \Carbon\Carbon::parse($item->sale_date)->format('d m Y') }}</div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('Add to System at') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">
                                    {{ \Carbon\Carbon::parse($item->created_at)->format('d m Y h:i:s A') }}</div>
                            </div>





                            {{-- ---------- About Fuel -------- --}}
                            <h5 class="ui header"><i class="bi bi-droplet-half"></i> {{ __('About Fuel') }}</h5>
                            <div class="row">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('Fuel Type') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">{{ $item->fuelType->fuel_type_kh }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4"></div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7 text-capitalize">{{ $item->fuelType->fuel_type_en }}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('Quantity') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">{{ $item->quantity }} {{ __('L') }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('Todays Fuel Price') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">{{ $item->fuelType->today_price }} $</div>
                            </div>


                            {{-- ------------- Customer ----------- --}}
                            <h5 class="ui header"><i class="bi bi-person"></i> {{ __('About Customer') }}</h5>

                            <div class="row">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('Customer Code') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">{{ $item->customer->customer_code }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('Customer Name') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">{{ $item->customer->fullname_kh }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4"></div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7 text-capitalize">{{ $item->customer->fullname_en }}
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('Contact Info') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">{{ $item->customer->phone ?? __('N/A') }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4"></div>
                                <div class="col-1"></div>
                                <div class="col-7 col-sm-7 col-md-7">{{ $item->customer->email ?? __('N/A') }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('Vichle Number') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">{{ $item->vichle_number }}</div>
                            </div>


                            {{-- ----------- Selling price ------------ --}}
                            <h5 class="ui header"><i class="bi bi-cash-coin"></i> {{ __('About Selling Price') }}</h5>

                            <div class="row">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('Unit Price') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">{{ $item->unit_price }} $</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('Discount') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">{{ $item->discount }} %</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('Total Price') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">{{ $item->total_price }} $</div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-4 col-sm-4 col-md-4">{{ __('Payment Method') }}</div>
                                <div class="col-1">:</div>
                                <div class="col-7 col-sm-7 col-md-7">
                                    @if ($item->payment_method == '1')
                                        <i class="bi bi-cash-coin icon"></i>{{ __('Cash') }}
                                    @elseif ($item->payment_method == '2')
                                        <i class="bi bi-credit-card icon"></i>{{ __('Credit/Debit Cards') }}
                                    @elseif ($item->payment_method == '3')
                                        <i class="bi bi-phone icon"></i>{{ __('Mobile Payments') }}
                                    @else
                                        <i class="bi bi-bank"></i>{{ __('Bank Transfers') }}
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.direct-chat -->
        </div>

        {{-- Invoice section  --}}
        <div class="col-lg-6 connectedSortable">
            <!-- /.card -->
            <!-- DIRECT CHAT -->
            <div class="card  mb-4">
                <div class="card-header text-white bg-primary bg-gradient border-primary">
                    <h3 class="card-title">{{ __('Invoice') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool m-0" data-lte-toggle="card-collapse">
                            <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                            <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                        </button>
                        <a type="button" id="printInvoiceBtn" class="ui button mini inverted m-0"><i
                                class="bi bi-printer icon"></i>{{ __('Print') }}</a>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-3">
                    {{-- <div class="bg-table-loader">
                        <div class="loader"></div>
                    </div> --}}
                    <div class="row">
                        <div class="col-md-12" id="invoice">
                            <div class="row">
                                <div class="col-6">
                                    <img src="{{ asset('dist/assets/img/logo.png') }}" alt="FMS-Logo" class="ui image"
                                        width="100px">
                                    {{-- <small>{{config('app.name')}}</small> --}}
                                </div>
                                <div class="col-6 text-end normal-text">
                                    <h5 class="text-end ui header medium text-uppercase">{{ __('Invoice') }}</h5>
                                    <p>No : {{ $item->sale_code }}</p>
                                    <p>{{ __('Date') }} :
                                        {{ \Carbon\Carbon::parse($item->sale_date)->format('d-m-Y') }}</p>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">[ {{ __('Customer Code') }} : #{{ $item->customer->customer_code }} ]
                                </div>
                                <div class="col-12 mt-1">[ {{ __('Customer Name') }} : {{ $item->customer->fullname_kh }}
                                    - <small class="text-uppercase">{{ $item->customer->fullname_en }}</small> ]</div>
                                <div class="col-12 mt-1"><i class="bi bi-car-front icon"></i>#{{ $item->vichle_number }}
                                </div>
                                <div class="col-12 mt-1"><i class="bi bi-telephone icon"></i>(+855)
                                    {{ $item->customer->phone }}</div>
                                <div class="col-12 mt-1"><i
                                        class="bi bi-envelope-at icon"></i>{{ $item->customer->email }}</div>
                                <div class="col-12 mt-1"><i class="bi bi-geo-alt icon"></i><small
                                        class="">{{ $item->customer->address }}</small></div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                {{-- <th>{{__("No.")}}</th> --}}
                                                <th>{{ __('Description') }}</th>
                                                <th>{{ __('Quantity') }}</th>
                                                <th>{{ __('Unit Price') }}</th>
                                                <th>{{ __('Discount') }}</th>
                                                <th>{{ __('Amount') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                {{-- <th>1</th> --}}
                                                <td>{{ $item->note }}</td>
                                                <td>{{ $item->quantity }} {{ __('L') }}</td>
                                                <td>{{ $item->unit_price }} $</td>
                                                <td>{{ $item->discount }} %</td>
                                                <td>{{ $item->total_price }} $</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="text-end">{{ __('Total') }}</td>
                                                <th>{{ $item->total_price }} $</th>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <p class="text-center">{{ __('Thank you for being so supportive of our service.') }}
                                    </p>
                                </div>
                            </div>
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
        $(document).on('click', '#printInvoiceBtn', function() {
            var content = $('#invoice').html();
            var myWindow = window.open('', '', 'width=800,height=500');
            myWindow.document.write(`
            <html><head>
                <title>Print Invoice</title>
                <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}" />
                <style>
                    @font-face {
                        font-family: 'Akbaltom Nagar';
                        src: url('/fonts/AKbalthom-Naga.ttf') format('truetype');
                        font-weight: normal;
                    }
                    @font-face {
                        font-family: 'Poppins';
                        src: url('/fonts/Poppins-Regular.ttf') format('truetype');
                        font-weight: normal;
                    }
                    * {
                        font-family: 'Poppins', 'Lato', 'Helvetica Neue', 'Akbaltom Nagar', sans-serif !important;
                    }
                    body{
                        margin: 15px !important;
                    }
                </style>
            `);
            myWindow.document.write('</head><body>');
            myWindow.document.write(content);
            myWindow.document.write('</body></html>');
            myWindow.document.close();
            myWindow.print();
        });
    </script>
@endsection
