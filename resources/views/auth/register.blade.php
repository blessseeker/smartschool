@extends('layouts.app')

@section('content')
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html">Smartschool</a>
                    </div>
                    <h1 class="auth-title">{{ __('Register') }}</h1>
                    <p class="auth-subtitle mb-5">Input your data to register to Smartschool.</p>

                    <form action="index.html">
                        <div class="form-group position-relative has-icon-left mb-4" action="{{ route('register') }}">
                            <input type="text" class="form-control form-control-xl @error('email') is-invalid @enderror"
                                placeholder="Email" value="{{ old('email') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text"
                                class="form-control form-control-xl @error('school_name') is-invalid @enderror"
                                placeholder="School Name" value="{{ old('school_name') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>

                            @error('school_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password"
                                class="form-control form-control-xl @error('password') is-invalid @enderror"
                                placeholder="Password" value="{{ old('password') }}">
                            <div class="  form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password"
                                class="form-control form-control-xl @error('confirm_password') is-invalid @enderror"
                                placeholder="Confirm Password" value="{{ old('confirm_password') }}">
                            <div class="  form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        @error('confirm_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign Up</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Already have an account? <a href="{{ route('login') }}"
                                class="font-bold">Log
                                in</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
@endsection
