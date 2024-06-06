@extends('layouts.dashboard.app')

@section('title', 'User Management')

@section('breadcrumb')
<x-dashboard.breadcrumb title="User Management" page="User Management" active="Users" route="{{ route('settings.user') }}" />
@endsection

@section('content')
<div class="card card-height-100 table-responsive">
    <!-- cardheader -->
    <div class="card-header border-bottom-dashed align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">User</h4>
        <div class="flex-shrink-0">
            @if ($hakAksesCreate)
            <a href="{{ route('settings.user.create') }}" type="button" class="btn btn-soft-primary btn-sm">
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
                        <th scope="col" class="min-w-350px">Email</th>
                        <th scope="col" class="min-w-80px">status</th>
                        <th scope="col" class="min-w-80px">Role</th>
                        <th scope="col" class="min-w-80px">Actions</th>
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
            ajax: {
                url : "{{ route('settings.user') }}",
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
                { data: 'email', name: 'email' },
                {
                data: 'log_user',
                name: 'log_user',
                    render: function(data, type, row) {
                        let html = "";
                            let warna = '';
                            let logout = '';
                            if(row['log_user'] == 'login'){
                                warna = 'primary';
                            }else{
                                warna = 'danger';
                            }

                            if(row['tanggal_logout']){
                                logout = row['tanggal_logout'];
                            }else{
                                logout = row['updated_at'];
                            }
                            html += `
                                <div class='d-flex'>
                                    <div>
                                        <a href="javascript:;" class="text-${warna} fw-bolder mb-1">${row['log_user'] ? row['log_user'] : 'logout'}</a>
                                        <div class='text-${warna} fs-10 fw-bolder'>
                                            ${row['action'] == 'login' ? moment(row['tanggal_login']).format('HH:mm:ss') : moment(logout).format('HH:mm:ss') }
                                        </div>
                                    </div>
                                </div>
                            `;
                        return html;
                    },
                },
                { data: 'roles', name: 'roles' },
                { data: 'action', name: 'action', className: "text-center", orderable: false, searchable: false },
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
                        url : "{{ route('settings.user.destroy') }}",
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
