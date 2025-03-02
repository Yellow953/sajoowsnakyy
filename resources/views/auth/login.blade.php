@extends('auth.app')

@section('title', 'login')

@section('content')
<!--begin::Form-->
<form class="form w-100" id="kt_sign_in_form" method="POST" action="{{ route('login') }}">
    @csrf
    <!--begin::Heading-->
    <div class="text-center mb-11">
        <!--begin::Title-->
        <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
        <!--end::Title-->
    </div>

    <!--begin::Input group=-->
    <div class="fv-row mb-8">
        <!--begin::Email-->
        <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent"
            required autofocus value="{{ old('email') }}" />
        <!--end::Email-->
    </div>
    <!--end::Input group=-->
    <div class="fv-row mb-3">
        <!--begin::Password-->
        <input type="password" placeholder="Password" name="password" autocomplete="off"
            class="form-control bg-transparent" required />
        <!--end::Password-->
    </div>
    <!--end::Input group=-->
    <!--begin::Wrapper-->
    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
        <label>
            <input type="checkbox" name="remember"> Remember Me
        </label>
        <div></div>

        <!--begin::Link-->
        <a href="{{ route('password.request') }}" class="link-yellow">Forgot Password ?</a>
        <!--end::Link-->
    </div>
    <!--end::Wrapper-->
    <!--begin::Submit button-->
    <div class="d-grid mb-10">
        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
            <!--begin::Indicator label-->
            <span class="indicator-label">Sign In</span>
            <!--end::Indicator label-->
            <!--begin::Indicator progress-->
            <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
            <!--end::Indicator progress-->
        </button>
    </div>
    <!--end::Submit button-->
</form>
<!--end::Form-->
@endsection

@section('scripts')
<!--begin::Custom Javascript(used for this page only)-->
<script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
<!--end::Custom Javascript-->
@endsection