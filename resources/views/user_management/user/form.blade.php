@extends('layouts.dashboard.app')

@section('title', 'User Management')

@section('breadcrumb')
<x-dashboard.breadcrumb title="User Management" page="User Management" active="User {{ $data->id ? 'Edit' : 'Create'}}" route="{{ route('settings.user') }}" />
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="">
            <div class="modal-header">
                <h5>{{ $data->id ? 'Edit' : 'Create'}} User</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" value="{{ $data->id }}" id="id">   
                <input type="hidden" value="{{ $data->description }}" id="value_desc">   
                
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="name" class="form-label required">Name</label>
                            <input type="text" class="form-control" value="{{ $data->name }}" id="name" placeholder="User Name" name="name">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="email" class="form-label required">Email</label>
                            <input type="email" class="form-control" value="{{ $data->email }}" id="email" placeholder="Email" name="email">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="password" class="form-label required">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label required">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password" name="confirm_password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="role" class="form-label required">Select Role</label>
                            <select class="form-control" id="role" name="role" data-choices data-choices-removeItem>
                                @foreach ($roles as $role)
                                <option @selected($data->hasRole($role->name)) value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                       
                    </div>
                </div>
            </div>
        </form>
        <center>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('settings.user') }}" class="btn btn-light btn-active-light-primary me-2"><i class="ki-duotone ki-arrow-left fs-4 ms-1 me-0">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>Kembali</a>
                <button type="button" class="btn btn-primary me-10" id="simpan">
                    <span class="indicator-label">
                        Submit
                    </span>
                    <span class="indicator-progress" style="display: none;">
                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
            </div>
        </center>
    </div>
</div>

@endsection

@push('script_processing')
<script>

var textarea = $('#description'); 
var newValue = $('#value_desc').val();
textarea.val(newValue); 

let button = document.querySelector("#simpan");
button.addEventListener("click", function() {
    $('.indicator-progress').show();
    $('.indicator-label').hide();
    let id = $('#id').val();
    let url;
    let title;
    if(id) {
        url = "{{ route('settings.user.update') }}";
    }else{
        url = "{{ route('settings.user.store') }}";
    }
    
    $.ajax({
        type: "POST",
        url: url,
        data: {
            _token: "{{ csrf_token() }}",
            id: id,
            name: $('#name').val(),
            email: $('#email').val(),
            password: $('#password').val(),
            confirm_password: $('#confirm_password').val(),
            role: $('#role').val(),
        },
        success: function (res) {
            $('.indicator-progress').hide();
            $('.indicator-label').show();
            Swal.fire({
                icon: 'success',
                title: res.text,
                showConfirmButton: false,
                timer: 1500
            }).then((res) => {
                window.location.href = "{{ route('settings.user') }}";
            })
        },
        error: function (xhr) {
            $('.indicator-progress').hide();
            $('.indicator-label').show();
            iziToast.warning({
                title: 'Gagal',
                message: xhr.responseJSON.text,
            });
        }
    });
});
</script>
@endpush