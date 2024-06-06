@extends('layouts.auth.app')

@section('title', 'log in')

@section('content')

{{-- <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css" /> --}}

	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Login Admin</h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<form action="{{ route('login') }}" method="POST">
                    @csrf
		      		<div class="form-group">
                        <input type="email" class="form-control" id="email"
                        placeholder="Enter email address" name="email" value="{{ old('email') }}"
                        required placeholder="Email" autocomplete="email" autofocus>
                    <x-form.validation.error name="email" />
		      		</div>
	                <div class="form-group">
                        <input type="password" class="form-control pe-5" placeholder="Enter password"
                        id="password-input" name="password" required placeholder="Password"
                        autocomplete="current-password">
	              <span id="password-addon" class="fa fa-fw fa-eye field-icon toggle-password"></span>
	                </div>
	                <div class="form-group">
                        <button class="btn btn-dark btn-submit w-100 btn-md"
                        type="submit">Masuk</button>
	            </form>
			</div>
		</div>
	</section>


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
