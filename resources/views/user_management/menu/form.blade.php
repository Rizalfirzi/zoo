@extends('layouts.dashboard.app')

@section('title', 'Menu Management')

@section('breadcrumb')
<x-dashboard.breadcrumb title="Menu Management" page="Menu Management" active="Menu {{ $data->id ? 'Edit' : 'Create'}}" route="{{ route('settings.permission') }}" />
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form>
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="modal-form-add-permission-label">Add Menu</h5>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Menu</label>
                    <input type="text" class="form-control" id="name" value="{{ $data->name}}" placeholder="Nama Menu" name="name">
                </div>

                <div id="route_panel">
                    <div class="mb-3">
                        <label for="route" class="form-label">Route</label>
                        <input type="text" class="form-control" id="route" value="{{ $data->route }}" placeholder="Nama Route" name="route">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="icon" class="form-label">Icon</label>
                    <input type="text" placeholder="Remix Icon (eg: ri-home-line)" class="form-control" id="icon" value="{{ $data->icon }}" name="icon">
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="level" class="form-label">Level</label>
                            <select class="form-control" id="level" name="level">
                                    <option @selected($data->level == 1 ) value="1" >1</option>
                                    <option @selected($data->level == 2 ) value="2" >2</option>
                                    {{-- <option @selected($data->level == 3 ) value="3" >3</option> --}}
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="position" class="form-label">Position</label>
                            <input type="number" class="form-control" value="{{ $data->position }}" id="position" placeholder="position" name="position">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-control" id="type" name="type">
                                <option {{ $data->type == 'static' ? 'selected' : '' }} value="static">Static</option>
                                <option {{ $data->type == 'dropdown' ? 'selected' : ''}} value="dropdown">Dropdown</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div id="grup_menu" style="{{ $data->level == 2 ? '' : 'display: none;' }}">
                    <div class="mb-3">
                        <label for="menu_group_id" class="form-label">Grup</label>
                        <select class="form-control" id="menu_group_id" name="menu_group_id" data-choices data-choices-removeItem>
                            @foreach ($groups as $item)
                                <option {{ $item->group == $data->group ? 'selected' : ''}} value="{{ $item->group }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div id="parent_menu" style="display: none;">
                    <div class="mb-3">
                        <label for="grup_select" class="form-label">Parent Menu</label>
                        <select class="form-control" id="grup_select" name="grup">
                                <option value="test" >test</option>
                                <option value="test" >test</option>
                                <option value="test" >test</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="roles[]" class="form-label">Role Name</label>
                    <select class="form-control" id="roles[]" name="roles[]" data-choices data-choices-removeItem multiple>
                        @foreach ($roles as $role)
                        @php
                            // $permission = $data->nama_permission;
                        @endphp
                        <option @selected($data->hasRole($role->name)) value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text" class="form-control" id="description" placeholder="Menu description" name="description"></textarea>
                </div>
                <input type="hidden" value="{{ $data->description }}" id="value_desc">   
                <input type="hidden" value="{{ $data->id}}" id="id">  
                {{-- @dd($data) --}}
            </div>
        </form>
        <center>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('settings.permission') }}" class="btn btn-light btn-active-light-primary me-2"><i class="ki-duotone ki-arrow-left fs-4 ms-1 me-0">
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
    $('#level').change(function(){
        var level_val = $(this).val();
        level_val = parseInt(level_val);
        switch(level_val) {
            case 2:
            $('#grup_menu').show();
            $('#parent_menu').hide();
            break;
            case  3:
            $('#grup_menu').show();
            $('#parent_menu').show()
            break;
            default:
            $('#grup_menu').hide();
            $('#parent_menu').hide();
            break;
        }
    });
    $('#type').change(function(){
        var type_val = $(this).val();
        switch(type_val) {
            case 'dropdown':
            $('#route_panel').hide();
            break;
            case 'static':
            $('#route_panel').show();
            break;
            default:
            $('#route_panel').show();
            break;
        }
    });


    var button = document.querySelector("#simpan");
    button.addEventListener("click", function() {
        $('.indicator-progress').show();
        let id = $('#id').val();
        let url;
        let title;
        if(id >= 1) {
            url = "{{ route('settings.permission.update') }}";
        }else{
            url = "{{ route('settings.permission.store') }}";
        };
        $.ajax({
            type: "POST",
            url: url,
            data: {
                _token: "{{ csrf_token() }}",
                id: $('#id').val(),
                name: $('#name').val(),
                route: $('#route').val(),
                icon: $('#icon').val(),
                level: parseInt($('#level').val(), 10),
                position: $('#position').val(),
                roles: $('[name="roles[]"]').val(),
                description: $('#description').val(),
                menu_group_id: $('#menu_group_id').val(),
                type: $('#type').val(),
            },
            success: function (res) {
                $('.indicator-progress').hide();
                Swal.fire({
                    icon: 'success',
                    title: res.text,
                    showConfirmButton: false,
                    timer: 1500
                }).then((res) => {
                    window.location.href = "{{ route('settings.permission') }}";
                })
            },
            error: function (xhr) {
                $('.indicator-progress').hide();
                button.removeAttribute("data-kt-indicator");
                iziToast.warning({
                    title: 'Gagal',
                    message: xhr.responseJSON.text,
                });
            }
        });
    });
</script>
@endpush