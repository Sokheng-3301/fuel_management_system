@php

    $data = '';
    $user = DB::table('users')->where('id', @Auth::user()->id);
    if ($user) {
        $data = $user->get()->first();
        // dd($data);
    } else {
        $data = null;
    }

@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->

<head>
    @include('backend.components.meta')
    <title>FuelMS | @yield('title')</title>

    @yield('css')
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    @if (session('logedin'))
        <div id="preload-grettings">
            <video src="{{ asset('dist/assets/img/vdo/fuel-drop.mp4') }}" width="500" height="280" autoplay muted
                playsinline loop></video>
            {{-- <p class="">{{ __('lang.welcomeToSystem') }}</p> --}}
            {{-- <div class="loader"></div> --}}
        </div>
    @endif
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                    {{-- <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li> --}}
                </ul>
                <!--end::Start Navbar Links-->
                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                    <!--begin::Localization-->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-globe"></i>
                            <span class="navbar-badge badge text-bg-primary">
                                @if (@session('localization') == 'en')
                                    {{ __('EN') }} @else{{ __('KH') }}
                                @endif
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                            <a href="{{ route('lang', ['locale' => 'kh']) }}" class="dropdown-item">
                                <!--begin::Message-->
                                <span> <img src="{{ asset('dist/assets/img/Khmer.png') }}" width="18%"
                                        alt=""> {{ __('Khmer') }}</span>
                                <!--end::Message-->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('lang', ['locale' => 'en']) }}" class="dropdown-item">
                                <!--begin::Message-->
                                <span> <img src="{{ asset('dist/assets/img/English.png') }}" width="18%"
                                        alt=""> {{ __('English') }}</span>
                                <!--end::Message-->
                            </a>
                        </div>
                    </li>
                    <!--end::Localization-->
                    <!--begin::Messages Dropdown Menu-->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-chat-text"></i>
                            <span class="navbar-badge badge text-bg-danger">3</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <a href="#" class="dropdown-item">
                                <!--begin::Message-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="../../dist/assets/img/user1-128x128.jpg" alt="User Avatar"
                                            class="img-size-50 rounded-circle me-3" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h3 class="dropdown-item-title">
                                            Brad Diesel
                                            <span class="float-end fs-7 text-danger"><i
                                                    class="bi bi-star-fill"></i></span>
                                        </h3>
                                        <p class="fs-7">Call me whenever you can...</p>
                                        <p class="fs-7 text-secondary">
                                            <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!--end::Message-->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!--begin::Message-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="../../dist/assets/img/user8-128x128.jpg" alt="User Avatar"
                                            class="img-size-50 rounded-circle me-3" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h3 class="dropdown-item-title">
                                            John Pierce
                                            <span class="float-end fs-7 text-secondary">
                                                <i class="bi bi-star-fill"></i>
                                            </span>
                                        </h3>
                                        <p class="fs-7">I got your message bro</p>
                                        <p class="fs-7 text-secondary">
                                            <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!--end::Message-->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <!--begin::Message-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0">
                                        <img src="../../dist/assets/img/user3-128x128.jpg" alt="User Avatar"
                                            class="img-size-50 rounded-circle me-3" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h3 class="dropdown-item-title">
                                            Nora Silvester
                                            <span class="float-end fs-7 text-warning">
                                                <i class="bi bi-star-fill"></i>
                                            </span>
                                        </h3>
                                        <p class="fs-7">The subject goes here</p>
                                        <p class="fs-7 text-secondary">
                                            <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                                        </p>
                                    </div>
                                </div>
                                <!--end::Message-->
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                        </div>
                    </li>
                    <!--end::Messages Dropdown Menu-->
                    <!--begin::Notifications Dropdown Menu-->
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-bs-toggle="dropdown" href="#">
                            <i class="bi bi-bell-fill"></i>
                            <span class="navbar-badge badge text-bg-warning">15</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <span class="dropdown-item dropdown-header">15 Notifications</span>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="bi bi-envelope me-2"></i> 4 new messages
                                <span class="float-end text-secondary fs-7">3 mins</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="bi bi-people-fill me-2"></i> 8 friend requests
                                <span class="float-end text-secondary fs-7">12 hours</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item">
                                <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                                <span class="float-end text-secondary fs-7">2 days</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
                        </div>
                    </li>
                    <!--end::Notifications Dropdown Menu-->
                    <!--begin::Fullscreen Toggle-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                        </a>
                    </li>
                    <!--end::Fullscreen Toggle-->
                    <!--begin::User Menu Dropdown-->
                    {{-- <img src="../../dist/assets/img/user2-160x160.jpg"
                                class="user-image rounded-circle shadow" alt="User Image" />
                            <span class="d-none d-md-inline">Alexander Pierce</span> --}}

                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ asset($data->profile ?? 'dist/assets/img/avatar4.png') }}"
                                class="user-image rounded-circle shadow" alt="User Image" />
                            <span class="d-none d-md-inline">
                                @if (@$data->gender == 'm')
                                    {{ __('Mr.') }}
                                @else
                                    {{ __('Mrs.') }}
                                @endif
                                @if (session()->has('localization') && session('localization') == 'en')
                                    {{ @$data->fullname_en ?? __('lang.unknown') }}
                                @else
                                    {{ @$data->fullname_kh ?? __('lang.unknown') }}
                                @endif
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::User Image-->
                            <li class="user-header text-bg-success ">
                                <img src="{{ asset($data->profile ?? 'dist/assets/img/avatar4.png') }}"
                                    class="rounded-circle shadow" alt="User Image" />
                                <p>
                                    @if (@$data->gender == 'm')
                                        {{ __('Mr.') }}
                                    @else
                                        {{ __('Mrs.') }}
                                    @endif

                                    @if (session()->has('localization') && session('localization') == 'en')
                                        {{ @$data->fullname_en ?? __('lang.unknown') }}
                                    @else
                                        {{ @$data->fullname_kh ?? __('lang.unknown') }}
                                    @endif
                                    <span class="text-capitalize">({{ @$data->role }})</span>
                                    <small>{{ __('ID Card') . ' :  ' }} {{ @$data->id_card ?? '00000' }}</small>
                                    {{-- <small>{{__("lang.loginAs") . ' :  '. __("lang.teacher")}}</small> --}}
                                    <hr class="my-2">
                                    <small class="d-block">
                                        {{ __('Login date') . ' : ' . (@Auth::user() && @Auth::user()->login_at ? \Carbon\Carbon::parse(@Auth::user()->login_at)->format('d M Y') : '-') }}
                                    </small>
                                    <small class="d-block">
                                        {{ __('Login time') . ' : ' . (@Auth::user() && @Auth::user()->login_at ? \Carbon\Carbon::parse(@Auth::user()->login_at)->format('h:i:s A') : '-') }}
                                    </small>
                                </p>
                            </li>
                            <!--end::User Image-->
                            <!--begin::Menu Body-->
                            {{-- <li class="user-body">
                                <!--begin::Row-->
                                <div class="row">
                                    <div class="col-4 text-center"><a href="#">Followers</a></div>
                                    <div class="col-4 text-center"><a href="#">Sales</a></div>
                                    <div class="col-4 text-center"><a href="#">Friends</a></div>
                                </div>
                                <!--end::Row-->
                            </li> --}}
                            <!--end::Menu Body-->
                            <!--begin::Menu Footer-->
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <li class="dropdown-item">
                                    <a href="" class="d-flex align-items-center a-profile">
                                        <i class="bi bi-person-circle me-2"></i>
                                        <span>{{ __('Profile') }}</span>
                                    </a>
                                <li class="dropdown-item">
                                    <a href="" class="d-flex align-items-center a-profile">
                                        <i class="bi bi-person-fill me-2"></i>
                                        <span>{{ __('Edit profile') }}</span>
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="" class="d-flex align-items-center a-profile">
                                        <i class="bi bi-key-fill me-2"></i>
                                        <span>{{ __('Change password') }}</span>
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="" class="d-flex align-items-center a-profile">
                                        <i class="bi bi-gear-fill me-2"></i>
                                        <span>{{ __('Settings') }}</span>
                                    </a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="{{ route('logout') }}" class="d-flex align-items-center a-profile">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        <span>{{ __('Logout') }}</span>
                                    </a>
                                </li>
                            </ul>
                            {{-- <li class="user-footer">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-end">Sign
                                    out</a>
                            </li> --}}
                            <!--end::Menu Footer-->
                        </ul>
                    </li>
                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->
        <!--begin::Sidebar-->
        @include('backend.components.sidebar')
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">@yield('title')
                                {{-- <small
                                    class="ps-1 text-muted fw-normal text-capitalize"
                                    style="font-size: 12px">{{ env('APP_NAME') }}
                                </small> --}}
                            </h3>
                        </div>

                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a type="button" id="prevBtn" class="ui button mini"><i
                                    class="bi bi-arrow-left icon"></i> {{ __('Back') }}</a>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->

                <div class="container-fluid">
                    @yield('content')
                </div>


                <!--end::Container-->
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        <footer class="app-footer">
            <div id="scrollTop">
                <i class="bi bi-arrow-up"></i>
            </div>
            <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">{{ config('app.version') }}</div>
            <!--end::To the end-->
            <!--begin::Copyright-->
            <strong>
                {{ __('Copyright') }} &copy; {{ date('Y') }}&nbsp;
                <a href="" target="_blank" class="text-decoration-none">{{ __('SLHT') }}</a> -
            </strong>
            {{ __('IT Department') }}
            <!--end::Copyright-->
        </footer>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    @include('backend.components.script')
    <script>
        // $(window).on('load', function() {
        //     $('#preload-grettings').fadeOut(5000, function() {
        //         $(this).animate({ top: '-5000px' }, 10);
        //     });
        // });
        $(window).on('load', function() {
            $('#preload-grettings').fadeOut(5000, function() {
                $('#preload-grettings').addClass({
                    top: '-5000px'
                }, 10);
            });
        });
    </script>

    <script>
        $('#prevBtn').on('click', function() {
            window.history.back();
        });
        $(document).ready(function() {
            // $('#myTable').DataTable();


            $('#myTable').DataTable({
                "language": {
                    "search": "{{ __('Search') }}",
                    "lengthMenu": "{{ __('Show') }} _MENU_ {{ __('Records') }}",
                    "info": "{{ __('Showing') }} _START_ {{ __('to') }} _END_ {{ __('of') }} _TOTAL_ {{ __('Records') }}",
                    "infoEmpty": "{{ __('No Records Found') }}",
                    "paginate": {
                        "next": "{{ __('Next') }}",
                        "previous": "{{ __('Previous') }}"
                    }
                },
                "lengthMenu": [5, 15, 25, 50, 75, 100, -1], // Options for the dropdown
                "pageLength": 15 // Default number of records to show
            });


            setTimeout(function() {
                $('#tableReload').fadeOut();
            }, 1000);
        });
    </script>
    @if (session()->has('success'))
        <script>
            $(document).ready(function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "success",
                    title: "{{ session('success') }}"
                });
            });
        </script>
    @endif

    @if (session()->has('error'))
        <script>
            $(document).ready(function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: "error",
                    title: "{{ session('error') }}"
                });
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {

            @if(session()->has('success'))
                Swal.fire({
                    icon: "success",
                    title: "{{ __('Success') }}",
                    text: "{{ session('success') }}",
                    draggable: true,
                    showConfirmButton: false,
                    timer : 3000
                });
            @endif

            @if(session()->has('error'))
                Swal.fire({
                    title: "{{ __('Error') }}",
                    text: "{{ session('error') }}",
                    icon: "error",
                    draggable: true,
                    showConfirmButton: false,
                    timer : 3000
                });
            @endif



            // Show the button when scrolled down 200px
            // $('#scrollTop').hide();

            $(window).scroll(function() {
                if ($(this).scrollTop() > 200) {
                    $('#scrollTop').css('display', 'flex');
                    $('#scrollTop').fadeIn();
                } else {
                    $('#scrollTop').css('display', 'none');
                    $('#scrollTop').fadeOut();
                }
            });

            // On click, scroll to top
            $('#scrollTop').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 200);
            });
        });

        // Hide the preload-grettings after page load
        $(window).on('load', function() {
            $('#preload-grettings').fadeOut(5000);
        });
    </script>
    @yield('js')
    <!--end::Script-->
</body>
<!--end::Body-->

</html>
