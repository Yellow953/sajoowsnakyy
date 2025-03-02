<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->

<head>
    <title>YellowPOS | {{ ucwords(View::yieldContent('title')) }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('assets/images/yellowpos_favicon.png') }}" />

    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<!--end::Head-->

<body id="kt_body" class="app-blank custom_scroller">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-0 p-md-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-300px w-lg-500px p-0 p-md-10">
                        <div class="d-md-none d-flex align-items-center justify-content-center">
                            <img src="{{ asset('assets/images/yellowpos_black_transparent_bg.png') }}" alt="logo"
                                class="mb-10" width="150" height="150">
                        </div>

                        @include('layouts._flash')

                        @yield('content')
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->
            </div>
            <!--end::Body-->
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2 pb-5"
                style="background-image: url({{ asset('assets/images/auth-bg.png') }})">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center pt-0 pb-5 px-5 px-md-15 w-100">
                    <!--begin::Logo-->
                    <a href="#" class="d-none d-md-block mb-0">
                        <img alt="Logo" src="{{ asset('assets/images/yellowpos_yellow_transparent_bg.png') }}"
                            class="h-100px h-lg-200px" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Image-->
                    <img class="mx-auto w-275px w-md-50 w-xl-350px my-10 my-md-0"
                        src="{{ asset('assets/images/banner.png') }}" />
                    <!--end::Image-->
                    <!--begin::Title-->
                    <h1 class="d-none d-lg-block text-yellow fs-2qx fw-bolder text-center mb-7">Quick, Reliable, and
                        Innovative</h1>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="d-none d-lg-block text-yellow fs-paragraph text-center">Streamline your store
                        operations with our advanced POS system,
                        designed for speed, accuracy, and enhanced customer
                        satisfaction.
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>

    <!--begin::Javascript-->
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--end::Javascript-->
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.querySelector('.alert');
            if (alert) {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 5000);
            }
        });
    </script>

    @yield('scripts')
</body>

</html>