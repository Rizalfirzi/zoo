@extends('layouts.auth.app')

@section('title', 'Sign In')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4">

                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <h5 class="text-primary">Welcome Back !</h5>
                        <p class="text-muted">Sign in to continue to Velzon.</p>
                    </div>
                    <div class="p-2 mt-4">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email address"
                                    name="email" value="{{ old('email') }}" required placeholder="Email"
                                    autocomplete="email" autofocus>
                                <x-form.validation.error name="email" />
                            </div>

                            <div class="mb-3">
                                <div class="float-end">
                                    <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                                </div>
                                <label class="form-label" for="password-input">Password</label>
                                <div class="position-relative auth-pass-inputgroup mb-3">
                                    <input type="password" class="form-control pe-5" placeholder="Enter password"
                                        id="password-input" name="password" required placeholder="Password"
                                        autocomplete="current-password">
                                    <button
                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted"
                                        type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                    <x-form.validation.error name="password" />
                                </div>
                            </div>

                            {{-- <center>
                                <div class="mt-4 mb-3">
                                    <div class="captcha">
                                        <span>{!! captcha_img('flat') !!}</span>&nbsp;
                                        <button type="button" class="btn btn-danger reload"
                                            id="reload">&#x21bb;</button>
                                    </div>
                                </div>
                            </center>
                            <div class="wrap-input100 validate-input mb-3">
                                <div class="container-fluid">
                                    <input type="text" id="captcha" name="captcha" placeholder="Enter captcha"
                                        class="form-control">
                                    <x-form.validation.error name="captcha" />
                                </div>
                            </div> --}}

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="auth-remember-check"
                                    name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="auth-remember-check">Remember me</label>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-success w-100" type="submit">Sign In</button>
                            </div>

                            <div class="mt-4 text-center">
                                <div class="signin-other-title">
                                    <h5 class="fs-13 mb-4 title">Sign In with</h5>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary btn-icon waves-effect waves-light"><i
                                            class="ri-facebook-fill fs-16"></i></button>
                                    <button type="button" class="btn btn-danger btn-icon waves-effect waves-light"><i
                                            class="ri-google-fill fs-16"></i></button>
                                    <button type="button" class="btn btn-dark btn-icon waves-effect waves-light"><i
                                            class="ri-github-fill fs-16"></i></button>
                                    <button type="button" class="btn btn-info btn-icon waves-effect waves-light"><i
                                            class="ri-twitter-fill fs-16"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="mt-4 text-center">
                <p class="mb-0">Don't have an account ? <a href="{{ route('register') }}"
                        class="fw-semibold text-primary text-decoration-underline"> Signup </a> </p>
            </div>

        </div>
    </div>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        // 

        // Show Password
        document.addEventListener('DOMContentLoaded', function() {
            const password = document.getElementById("password-input");
            const btn_show = document.getElementById("password-addon");

            btn_show.addEventListener("click", function() {
                if (password.type === "password") {
                    password.type = "text";
                    btn_show.innerHTML = '<i class="ri-eye-off-fill align-middle"></i>';
                } else {
                    password.type = "password";
                    btn_show.innerHTML = '<i class="ri-eye-fill align-middle"></i>';
                }
            });
        });
    </script>
@endsection
