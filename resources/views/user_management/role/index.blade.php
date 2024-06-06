@extends('layouts.dashboard.app')

@section('title', 'Role Management')

@section('breadcrumb')
<x-dashboard.breadcrumb title="Role Management" page="Role Management" active="Role" route="{{ route('settings.role') }}" />
@endsection

@section('content')
<div class="card card-height-100 table-responsive">
    <!-- cardheader -->
    <div class="card-header border-bottom-dashed align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Role</h4>
        <div class="flex-shrink-0">
            @if ($hakAksesCreate)
            <a href="{{ route('settings.role.create') }}" type="button" class="btn btn-soft-primary btn-sm">
                <i class="ri-add-line"></i>
                Add
            </a>
            @endif
        </div>
    </div>
    <!-- end cardheader -->
    <!-- Hoverable Rows -->
    <div class="card-body py-3">
        <div class="table-responsive">
            <table class="table table-hover table-nowrap mb-0" id="dataTable">
                <thead>
                    <tr class="fw-bolder">
                        <th scope="col">No</th>
                        <th scope="col" class="min-w-100px">Name</th> 
                        <th scope="col" class="min-w-80px">Description</th>
                        <th scope="col" class="min-w-350px">Menu</th>
                        <th scope="col" class="min-w-80px">Actions</th>
                    </tr>
                </thead>
                <tbody class="">
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- Modal Show --}}
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Menu</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('script_processing')
<script>

function loadData() {
    var table =  $('#dataTable').DataTable({
        pageLength : 10,
        searching: true,
        serverSide: true,
        processing: true,   
        ajax: {
            url : "{{ route('settings.role') }}",
            type: 'GET',
        },
        
        columnDefs: [
            {
            "defaultContent": "-",
            "targets": "_all"
            }
        ],
        columns: [
            {
                data: 'DT_RowIndex',
            },
            { data: 'name', name: 'name' },
            { data: 'description', name: 'description' },
            { data: 'menu', name: 'menu' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ],
    });
}
$(document).ready(function() {
    loadData();

    $(document).on('click', '.lihat-menu', function(){
        var id = $(this).data('id');
        var user_id = $(this).data('userid');
        let url = '{{ route('settings.role.show', [':id', ':user_id']) }}';
        url = url.replace(':id', id);
        url = url.replace(':user_id', user_id);

        $('.modal-body').empty();
        $('.modal-body').append('<i>please wait ...</i>');
        $.ajax({
            type: "get",
            url: url,
            success: function (response) {
                let html = `<div class="row">
                                <div class="col-sm-12">
                                    <div class="verti-sitemap">
                                        <ul class="list-unstyled mb-0">
                                            <li class="p-0 parent-title"><a href="javascript: void(0);"
                                                    class="bi bi-arrow-right-circle"><b>${response.role}</b></a>
                                            </li>`;

                $.map(response.list_permission, function (permission) {
                            html += `<li>
                                        <div class="first-list">`;
                                    if(permission.level === 2) {
                                        html += `<ul class="second-list list-unstyled">
                                                        <li>
                                                            <a href="javascript: void(0);"><i
                                                                    class=" me-1 align-bottom"></i>${permission.name}</a>
                                                            
                                                        </li>
                                                    </ul>`;
                                    }else{
                                        html += `
                                                
                                                        <div class="list-wrap">
                                                            <a href="javascript: void(0);"
                                                                class="fw-medium">
                                                                <i class="${permission.icon} me-1 align-bottom"></i>${permission.name}</a>
                                                        </div>
                                                   `;
                                    }
                            html += ` </div>
                                </li>`;        
                });
                                html += `</ul>
                                    </div>
                                </div>
                            </div>`;
                $('.modal-body').html(html);        
            }
        });
    });
    
    $(document).on('click', '.delete', function () {
        let id = $(this).attr('id')
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : "{{ route('settings.role.destroy') }}",
                    type: 'post',
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(res, status){
                        if (status = '200'){
                            setTimeout(() => {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Data Berhasil Dihapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((res) => {
                                    $('#dataTable').DataTable().ajax.reload()
                                })
                            });
                        }
                    },
                    error: function(xhr){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: xhr.responseJSON.text,
                        })
                    }
                })
            }
        })
    });
});
</script>

@endpush