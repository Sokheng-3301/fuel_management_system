<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->

<head>
    @include('backend.components.meta')
    <title>FuelMS | {{ __('Login') }}</title>
    <style>
        #fix_boday {
            width: 100%;
            height: 100%;
            position: fixed;
            background: #ffffff;
        }

        .bg-img {
            /* width: 100%; */
            height: 100%;
            background-image: url("{{ asset('dist/assets/img/bg-login.jpg') }}");
            position: absolute;
            background-position: left;
            background-size: cover;
            background-repeat: no-repeat;


        }

        .bg-img-login {
            height: 100%;
            background-image: url("{{ asset('dist/assets/img/boxed-bg.png') }}");
            position: absolute;
            right: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login_button {
            background: #3c9841 !important;
            color: #ffff !important;
        }

        .login_button:hover {
            background: #1aa921 !important;
        }
    </style>
</head>

<body>
    <div id="fix_boday">
        <div class="row">
            <div class="col-md-7 bg-img">

            </div>
            <div class="col-md-5 bg-img-login">
                <div class="col-10 col-md-9 col-lg-8 col-xl-8">
                    <form action="{{ route('login.save') }}" method="POST" class="ui form">
                        @csrf
                        <img class="ui image small d-block mx-auto mb-4" src="{{ asset('dist/assets/img/logo.png') }}"
                            alt="">
                        {{-- <h1 class="ui header meduim">{{__('Login')}} </h1> --}}
                        @session('error')
                            <div class="ui negative message">
                                {{-- <i class="close bi bi-x icon"></i> --}}
                                {{-- <div class="header">
                                    {{ session('error') }}
                                </div> --}}
                                <p>{{ session('error') }}</p>
                            </div>
                        @endsession
                        <div class="field">
                            <label for="username">{{ __('Username') }}</label>
                            <div class="ui icon large input">
                                <i class="bi bi-person-fill icon"></i>
                                <input type="text" name="username" id="username" autofocus
                                    placeholder="{{ __('Username') }}" value="{{ old('username') }}">
                                {{-- <i class="bi bi-user icon"></i> --}}
                            </div>
                        </div>
                        <div class="field">
                            <label for="password">{{ __('Password') }}</label>
                            <div class="ui icon large input">
                                <i class="bi bi-lock-fill icon"></i>
                                <input type="password" name="password" id="password" autofocus
                                    placeholder="{{ __('Password') }}">
                                {{-- <i class="bi bi-user icon"></i> --}}
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" id="showPass" name="example">
                                <label for="showPass"> {{ __('Show password') }} </label>
                            </div>
                        </div>

                        <div class="ui error message"></div>

                        <button type="submit"
                            class="ui button login_button w-100 mt-3 large">{{ __('Login') }}</button>
                        <p class="m-0 mt-4 text-center">{{ __('Forgot password?') }} <a type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#readInfo"class="link text-success">{{ __('More info') }}</a></p>
                        <p class="mt-4 text-center text-muted">{{ config('app.version') }}</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="readInfo" tabindex="-1" aria-labelledby="readInfoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title ui medium header" id="readInfoLabel"> <i
                            class="bi bi-chat-right-text-fill pe-1"></i> {{ __('Message from Fuel System') }} </h5>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <h4 class="ui tiny header"> {{ __('About forgot password') }} </h4>
                    <p>
                        {{ __('Dear users! If you have forgotten your password or username to log in, please contact the system administrator to change your password or username for you.') }}
                    </p>
                    <p class="text">{{ __('Thank you') }}</p>
                    {{-- <h4 class="ui tiny header"> {{ __('lang.contactBy') }} </h4> --}}
                    {{-- <div class="ui message">
                        <div class="ui tiny header">
                            {{ __('lang.contactBy') }}
                        </div>
                        <ul class="list">
                            <li> 085 483 609 / 010 770 774/ 096 47 67 709</li>
                            <li><a class="link text-primary">info@ksit.edu.kh</a> </li>
                        </ul>
                    </div> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="ui tiny button " data-bs-dismiss="modal"> {{ __('Close') }}
                    </button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('dist/js/bootstrap.min.js') }}"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <script src="{{ asset('dist/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('dist/js/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/ui-css/semantic.min.js') }}"></script>
    <script src="{{ asset('dist/js/my.js.js') }}"></script>

    <script>
        $('.message .close').on('click', function() {
            $(this).closest('.message')
                .transition('fade');
        });

        $('.ui.form').form({
            fields: {
                username: {
                    identifier: 'username',
                    rules: [{
                        type: 'empty',
                        prompt: '{{ __('Please enter username') }}'
                    }]
                },
                password: {
                    identifier: 'password',
                    rules: [{
                        type: 'minLength[4]',
                        prompt: '{{ __('Please enter password less than 4 characters') }}'
                    }]
                },
            }
        });

        $(document).ready(function() {
            $('#showPass').on('change', function() {
                if ($('#password').attr('type') == 'password') {
                    $('#password').attr('type', 'text');
                } else {
                    $('#password').attr('type', 'password');
                }
            });
        });

        $('form').submit(function() {
            var submitButton = $('button[type="submit"]');
            submitButton.prop('disabled', true);
            submitButton.addClass('loading');

            setTimeout(function() {
                submitButton.prop('disabled', false);
                submitButton.removeClass('loading');
            }, 2000);
        });
    </script>
</body>

</html>
