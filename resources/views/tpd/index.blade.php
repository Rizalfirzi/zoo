@extends('layouts.dashboard.app')

@section('title', 'TPD')

@section('breadcrumb')
{{-- <x-dashboard.breadcrumb title="User Management" page="User Management" active="Users" route="{{ route('settings.user') }}" /> --}}
@endsection

@section('content')
<div class="card card-height-100 table-responsive">
    <!-- cardheader -->
    <div class="card-header border-bottom-dashed align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Data TPD</h4>
        <div class="flex-shrink-0">
            @if ($create)
                <a href="{{ route('tpd_dkpp.form') }}" type="button" class="btn btn-soft-primary btn-sm">
                    <i class="ri-add-line"></i>
                    Tambah Data
                </a>
            @endif

            {{-- <a href="{{ route('pegawai.rekap') }}" type="button" class="btn btn-soft-primary btn-sm">
                <i class="ri-add-line"></i>
                Rekap Data Pegawai
            </a> --}}
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
                        <th scope="col" class="">Provinsi</th>
                        <th scope="col" class="">Nama</th>
                        <th scope="col" class="">NPWP</th>
                        <th scope="col" class="">No.Hp</th>
                        <th scope="col" class="">No.Rekening</th>
                        <th scope="col" class="">Nama Bank</th>
                        <th scope="col" class="">Unsur TPD</th>
                        <th scope="col" class="">Jenis Profesi</th>
                        <th scope="col" class="">Jenis Kelamin</th>
                        <th scope="col" class="">Pendidikan Terakhir</th>
                        <th scope="col" class="">Foto</th>
                        <th scope="col" class="">Status Aktif</th>
                        @if ($update || $delete)
                            <th scope="col" class="">Aksi</th>
                        @endif
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
            order: [[1, 'asc']],
            ajax: {
                type: "POST",
                dataType: 'JSON',
                url : "{{ route('tpd_dkpp.index') }}",
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
                    name:'id',
                },
                { data: 'master_provinsi.province_name', name: 'kd_provinsi' },
                { data: 'nama', name: 'nama' },
                { data: 'npwp', name: 'npwp' },
                { data: 'no_hp', name: 'no_hp' },
                { data: 'no_rek', name: 'no_rek' },
                { data: 'master_bank.nm_bank', name: 'kd_bank' },
                { data: 'master_unsur_tpd.deskripsi', name: 'unsur_tpd' },
                { data: 'master_profesi.deskripsi', name: 'jns_profesi' },
                { data: 'nm_kelamin', name: 'jns_kelamin' },
                { data: 'master_pendidikan.deskripsi', name: 'jns_pendidikan' },
                { data: 'foto', name: 'foto' },
                { data: 'aktif', name: 'aktif' },

                @if ($update || $delete)
                    { data: 'aksi', name: 'aksi' },
                @endif

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
                        url : "{{ route('tpd_dkpp.destroy') }}",
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
