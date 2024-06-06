@extends('layouts.dashboard.app')

@section('title', 'Rekap Data TPD')

@section('breadcrumb')
{{-- <x-dashboard.breadcrumb title="User Management" page="User Management" active="Users" route="{{ route('settings.user') }}" /> --}}
@endsection

@section('content')
<div class="card card-height-100 table-responsive">
    <!-- cardheader -->
    <div class="card-header border-bottom-dashed align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Data TPD Berdasarkan Gender</h4>
    </div>
    <!-- end cardheader -->
    <!-- Hoverable Rows -->
    <div class="card-body py-3">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                      <th scope="col">Unsur TPD</th>
                      <th scope="col">Laki - Laki</th>
                      <th scope="col">Perempuan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                        $laki = 0;
                        $perempuan = 0;
                    @endphp
                    @foreach ($data as $rekap_data)
                        @php
                            $laki += $rekap_data->data_tpd_laki_count;
                            $perempuan += $rekap_data->data_tpd_perempuan_count;
                        @endphp
                        <tr>
                            <td>{{$rekap_data->deskripsi}}</td>
                            <td>{{$rekap_data->data_tpd_laki_count}}</td>
                            <td>{{$rekap_data->data_tpd_perempuan_count}}</td>
                        </tr>

                    @endforeach
                    <tr>
                        <td> TOTAL </td>
                        <td> {{$laki}} </td>
                        <td> {{$perempuan}} </td>

                    </tr>
                  </tbody>
            </table>
        </div>
    </div>

</div>

<div class="card card-height-100 table-responsive mt-3">
    <!-- cardheader -->
    <div class="card-header border-bottom-dashed align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Data TPD Berdasarkan Pendidikan</h4>
    </div>
    <div class="card-body py-3">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                      <th scope="col">Jenjang Pdidikan TPD</th>
                      <th scope="col">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($pendidikan as $rekap_pendidikan)
                        <tr>
                            <td>{{$rekap_pendidikan->deskripsi}}</td>
                            <td>{{$rekap_pendidikan->jml_data}}</td>
                        </tr>

                    @endforeach
                  </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card card-height-100 table-responsive mt-3">
    <!-- cardheader -->
    <div class="card-header border-bottom-dashed align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Data TPD Berdasarkan Pekerjaan</h4>
    </div>
    <div class="card-body py-3">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                      <th scope="col">Pekerjaan TPD</th>
                      <th scope="col">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($profesi as $rekap_profesi)
                        <tr>
                            <td>{{$rekap_profesi->deskripsi}}</td>
                            <td>{{$rekap_profesi->jml_data}}</td>
                        </tr>

                    @endforeach
                  </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('script_processing')
{{-- <script src="{{asset('assets/highchart11/code/highcharts.js')}}"></script> --}}
<script>

</script>
@endpush
