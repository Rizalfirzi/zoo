@extends('layouts.dashboard.app')

@section('title', 'Menu Management')

@section('breadcrumb')
<x-dashboard.breadcrumb title="Menu Management" page="Menu Management" active="Menus" route="{{ route('settings.permission') }}" />
@endsection

@section('content')
<div class="card card-height-100 table-responsive">
    <!-- cardheader -->
    <div class="card-header border-bottom-dashed align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Menu</h4>
        <div class="flex-shrink-0">
            <a href="{{ route('settings.permission.create') }}" type="button" class="btn btn-soft-primary btn-sm">
                <i class="ri-add-line"></i>
                Add
            </a>
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
                        <th scope="col" class="min-w-100px">Menu Name</th> 
                        <th scope="col" class="min-w-100px">Route</th> 
                        <th scope="col" class="min-w-100px">Level</th> 
                        <th scope="col" class="min-w-100px">Group</th> 
                        <th scope="col" class="min-w-100px">Position</th> 
                        <th scope="col" class="min-w-100px">Icon</th> 
                        <th scope="col" class="min-w-100px">Description</th> 
                        <th scope="col" class="min-w-100px">Action</th> 
                    </tr>
                </thead>
                <tbody class="">
                </tbody>
            </table>
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
            responsive: true,
            ajax: {
                url : "{{ route('settings.permission') }}",
                type: 'GET',
            },
            
            columnDefs: [
                {
                "defaultContent": " ",
                "targets": "_all"
                }
            ],
            columns: [
                {
                    data: 'DT_RowIndex',
                },
                { data: 'name', name: 'name' },
                { data: 'route', name: 'route' },
                { data: 'level', name: 'level' },
                { data: 'group', name: 'group' },
                { data: 'position', name: 'position' },
                {   
                    data: 'icon',
                    name: 'icon',
                    render: function(data, type, row) {
                        let html = "";
                        html +=
                            `<span class='${row['icon']}'></span>`;
                        return html;
                    }, 
                },
                { data: 'description', name: 'description' },
                { data: 'action', name: 'action'},
            ],
        });
    }
    $(document).ready(function() {
        loadData();
        
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
                        url : "{{ route('settings.permission.destroy') }}",
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