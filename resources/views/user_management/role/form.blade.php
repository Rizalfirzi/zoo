@extends('layouts.dashboard.app')

@section('title', 'Role Management')

@section('breadcrumb')
<x-dashboard.breadcrumb title="Role Management" page="Role Management" active="Role {{ @$data[0]->id ? 'Edit' : 'Create'}}" route="{{ route('settings.role') }}" />
@endsection

@section('content')
<div class="card">
    <div class="card-body">
        <form action="">
            <div class="modal-header">
                <h5>{{ @$data[0]->id ? 'Edit' : 'Create'}} Role</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" value="{{ @$data[0]->id }}" id="id">   
                <input type="hidden" value="{{ @$data[0]->description }}" id="value_desc">   
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" value="{{ @$data[0]->name }}" id="name" placeholder="Role Name" name="name">
                </div>
                <div class="row mb-3">
                <label class="mb-3">Assign Permission to Roles :</label>
                
                @foreach ($list_permission as $permission)
                    <?php
                    $checkedPermission = '';
                    $hakaksesIds = [];
                    
                    if (in_array($permission->id, $data_array)) {
                        $checkedPermission = 'checked';
                        foreach ($list_permission_checked as $val) {
                            if ($val->permission_id === $permission->id) {
                                $hakaksesIds[] = $val->hakakses_id;
                            }
                        }
                    }
                    ?>
                    <div class="permission-container">
                        @if($permission->level == 2)
                            <div class="d-flex bd-highlight" style="margin-left: 35.9px">
                                <div class="bd-highlight">
                                    <input type="checkbox" name="permission[]" id="permission_{{ $permission->id }}"
                                    value="{{ $permission->id }}" {{ $checkedPermission}}/>
                                    <span></span>
                                    <label for="permission_{{ $permission->id }}" class="checkbox checkbox-outline checkbox-success mb-3 mx-3">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @else  
                        <div class="d-flex bd-highlight">
                            <div class="bd-highlight">
                                <input type="checkbox" name="permission[]" id="permission_{{ $permission->id }}"
                                value="{{ $permission->id }}" {{ $checkedPermission}} />
                                <span></span>
                                <label for="permission_{{ $permission->id }}" class="checkbox checkbox-outline checkbox-success mb-3 mx-3">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        </div>  
                        @endif
                        
                        @if($permission->level == 2)
                        <ul style="margin-left: 35.9px;">
                        @else
                        <ul>
                        @endif
                            @foreach ($list_Hakakses as $key => $value)
                                <?php
                                $checkedHakakses = '';
                                if (in_array($value->id, $hakaksesIds)) {
                                    $checkedHakakses = 'checked';
                                }
                
                                $checkboxId = "hakakses_{$permission->name}_{$value->name}";
                                ?>
                                @if($permission->type == 'dropdown')
                                    @if($loop->index == 1)
                                        <label for="{{ $checkboxId }}" class="checkbox checkbox-outline checkbox-success mb-3 mx-1">
                                            <input type="checkbox" name="hakakses[]" id="{{ $checkboxId }}"
                                                value="{{ $value->id }}" {{ $checkedHakakses }} data-permission="{{ $permission->id }}" />
                                            {{ $value->name }}
                                        </label>
                                    @endif
                                    @else
                                    <label for="{{ $checkboxId }}" class="checkbox checkbox-outline checkbox-success mb-3 mx-1">
                                        <input type="checkbox" name="hakakses[]" id="{{ $checkboxId }}"
                                        value="{{ $value->id }}" {{ $checkedHakakses }} data-permission="{{ $permission->id }}" />
                                        {{ $value->name }}
                                    </label>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endforeach
                </div>
        
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea type="text" class="form-control" id="description" placeholder="Role description" name="description">{{ @$data[0]->description }}</textarea>
                </div>
            </div>
        </form>
        <center>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ route('settings.role') }}" class="btn btn-light btn-active-light-primary me-2"><i class="ki-duotone ki-arrow-left fs-4 ms-1 me-0">
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

@push('script')
<script>

$(document).ready(function() {
    document.querySelectorAll("input[name='permission[]']").forEach(function(permissionCheckbox) {
        permissionCheckbox.addEventListener("change", function() {
            var permissionChecked = this.checked;

            var permissionId = this.value;

            var relatedHakaksesCheckboxes = document.querySelectorAll("input[name='hakakses[]'][data-permission='" + permissionId + "']");

            relatedHakaksesCheckboxes.forEach(function(checkbox) {
                checkbox.checked = permissionChecked;
            });

            var permissionLabel = document.querySelector("label[for='permission_" + permissionId + "']").textContent;
        });
    });

    $('input[name="hakakses[]"]').on('change', function() {
        var permissionId = $(this).data('permission');

        var $relatedHakaksesCheckboxes = $('input[name="hakakses[]"][data-permission="' + permissionId + '"]');

        var checkedCount = $relatedHakaksesCheckboxes.filter(':checked').length;

        $('#permission_' + permissionId).prop('checked', checkedCount > 0);
    });

    document.querySelectorAll("input[name='hakakses[]']").forEach(function(hakaksesCheckbox) {
        hakaksesCheckbox.addEventListener("change", function() {
            var hakaksesChecked = this.checked;

            var hakaksesId = this.value;

            var permissionId = this.getAttribute("data-permission");

            var hakaksesLabel = document.querySelector("label[for='hakakses_" + hakaksesId + "']").textContent;
        });
    });
});    

</script>
@endpush

@push('script_processing')
<script>

var textarea = $('#description'); 
var newValue = $('#value_desc').val();
textarea.val(newValue); 


let button = document.querySelector("#simpan");
button.addEventListener("click", function() {
    $('.indicator-progress').show();
    let id = $('#id').val();
    let url;
    let title;
    if(id > 0 ) {
        url = "{{ route('settings.role.update') }}";
    }else{
        url = "{{ route('settings.role.store') }}";
    }
    
    let datas = [];
    $('input[name="permission[]"]:checked').each(function () {
        let permissionId = $(this).val();
        let hakaksesArr = [];
        let hakaksesSelected = $('input[name="hakakses[]"]:checked[data-permission="' + permissionId + '"]').length > 0;
        if (!hakaksesSelected) {
            Swal.fire('Permission with ID ' + permissionId + ' does not have any hakakses selected!', '', 'error');
            return; 
        }
        $('input[name="hakakses[]"]:checked[data-permission="' + permissionId + '"]').each(function () {
            let hakaksesId = $(this).val();
            hakaksesArr.push(hakaksesId);
        });
        datas.push({ permission_id: permissionId, hakakses: hakaksesArr });
    });
    $.ajax({
        type: "POST",
        url: url,
        data: {
            _token: "{{ csrf_token() }}",
            id: id,
            name: $('#name').val(),
            description: $('#description').val(),
            permissions: JSON.stringify(datas),
        },
        success: function (res) {
            $('.indicator-progress').hide();
            Swal.fire({
                icon: 'success',
                title: res.text,
                showConfirmButton: false,
                timer: 1500
            }).then((res) => {
                window.location.href = "{{ route('settings.role') }}";
            })
        },
        error: function (xhr) {
            $('.indicator-progress').hide();
            if(xhr.responseJSON.text == 'Anda tidak memiliki izin' ){
                    Swal.fire({
                    icon: 'error',
                    title: xhr.responseJSON.text,
                    showConfirmButton: false,
                    timer: 1500
                })
            }else{
                iziToast.warning({
                    title: 'Gagal',
                    message: xhr.responseJSON.text,
                });
            }
        }
    });
});
</script>
@endpush