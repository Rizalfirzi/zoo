@extends('layouts.dashboard.app')

@section('title', 'TPD')

@section('breadcrumb')
<x-dashboard.breadcrumb title="TPD" page="TPD" active="TPD {{ @$data->id ? 'Edit' : 'Create'}}" route="{{ route('tpd_dkpp.form') }}" />
@endsection

@push('css')
    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }
        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
        }

        #img-upload{
            max-width: 270px;
            /* max-height: 300px; */
        }
        .select2-container{
            width: 100% !important;
        }
    </style>
@endpush

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ @$data->id ? route('tpd_dkpp.form.edit', ['aksi' => 'edit','id' => $data->id]) : route('tpd_dkpp.form') }}" id="form_pegawai" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5>{{ @$data->id ? 'Edit' : 'Create'}} TPD</h5>
            </div>
            <div class="modal-body">

                <div class="row">
                    @error('data_error')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="col-lg-12">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="nama" class="form-label required">Nama</label>
                                <input type="text" class="form-control" value="{{ old('nama', @$data->nama) }}" id="nama" placeholder="nama" name="nama">
                            </div>
                            @error('nama')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="npwp" class="form-label required">NPWP</label>
                                <input type="text" class="form-control" value="{{ old('npwp', @$data->npwp) }}" id="nik" placeholder="npwp" name="npwp">
                            </div>
                            @error('npwp')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="no_hp" class="form-label required">No. Hp</label>
                                <input type="text" class="form-control" value="{{ old('no_hp', @$data->no_hp) }}" id="no_hp" placeholder="no_hp" name="no_hp">
                            </div>
                            @error('no_hp')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="no_rek" class="form-label required">No. Rekening</label>
                                <input type="text" class="form-control" value="{{ old('no_rek', @$data->no_rek) }}" id="no_rek" placeholder="no_rek" name="no_rek">
                            </div>
                            @error('no_rek')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="kd_bank" class="form-label required">Nama Bank</label>
                                <select class="form-control select2" id="kd_bank" name="kd_bank">
                                    @foreach ($master_bank as $bank)
                                        <option value="{{$bank->kd_bank}}" {{old('kd_bank', @$data->kd_bank) == $bank->kd_bank ? 'selected' : NULL }}>{{$bank->nm_bank}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('kd_bank')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="unsur_tpd" class="form-label required">Unsur TPD</label>
                                <select class="form-control select2" id="unsur_tpd" name="unsur_tpd">
                                    @foreach ($master_unsur_tpd as $jns_unsur)
                                        <option value="{{$jns_unsur->id}}" {{old('unsur_tpd', @$data->unsur_tpd) == $jns_unsur->id ? 'selected' : NULL }}>{{$jns_unsur->deskripsi}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('unsur_tpd')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="jns_profesi" class="form-label required">Profesi</label>
                                <select class="form-control select2" id="jns_profesi" name="jns_profesi">
                                    @foreach ($master_jns_profesi as $jns_profesi)
                                        <option value="{{$jns_profesi->id}}" {{old('jns_profesi', @$data->jns_profesi) == $jns_profesi->id ? 'selected' : NULL }}>{{$jns_profesi->deskripsi}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('jns_profesi')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-4">
                            <div class="mb-3">
                                <label for="jns_kelamin" class="form-label required">Pilih Jenis Kelamin</label>
                                <div class="col-md-12 mt-2">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jns_kelamin" id="inlineRadio1" value="1" {{old('jns_kelamin', @$data->jns_kelamin) == 1 ? 'checked' : NULL}}>
                                        <label class="form-check-label" for="inlineRadio1">Laki - Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jns_kelamin" id="inlineRadio2" value="2" {{old('jns_kelamin', @$data->jns_kelamin) == 2 ? 'checked' : NULL}}>
                                        <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                    </div>
                                </div>
                            </div>
                            @error('jns_kelamin')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="jns_pendidikan" class="form-label required">Pendidikan</label>
                                <select class="form-control select2" id="jns_pendidikan" name="jns_pendidikan">
                                    @foreach ($master_pendidikan as $jns_pendidikan)
                                        <option value="{{$jns_pendidikan->id}}" {{old('jns_pendidikan', @$data->jns_pendidikan) == $jns_pendidikan->id ? 'selected' : NULL }}>{{$jns_pendidikan->deskripsi}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('jns_pendidikan')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="provinsi" class="form-label required">Provinsi</label>
                                <select class="form-control select2" id="provinsi" name="provinsi">
                                    @foreach ($master_provinsi as $provinsi)
                                        <option value="{{$provinsi->no_province}}" {{old('provinsi', @$data->kd_provinsi) == $provinsi->no_province ? 'selected' : NULL }}>{{$provinsi->province_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('provinsi')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Upload Foto</label>
                                @error('foto')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <span class="btn btn-outline-primary btn-file">
                                            Browse… <input type="file" id="imgInp" accept="image/*" name="foto">
                                        </span>
                                    </span>
                                    <input type="text" class="form-control" readonly>
                                </div>
                                @php
                                    $foto = (@$data->foto) ? 'src ='.route('tpd_dkpp.image.displayImage', basename($data->foto)) : NULL;
                                @endphp
                                <img id='img-upload' {{$foto}} class="mt-2 p-3"/>
                            </div>

                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="aktif" class="form-label required">Status Aktif</label>
                                <select class="form-control" id="aktif" name="aktif">
                                    <option value="0" {{old('aktif', @$data->activetext) == 0 ? 'selected' : NULL}}>Tidak Aktif</option>
                                    <option value="1" {{old('aktif', @$data->activetext) == 1 ? 'selected' : NULL}}>Aktif</option>
                                </select>
                            </div>
                            @error('aktif')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
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
    <!-- Modal -->
    <div class="modal fade" id="modal_file_preview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="frame_kerjasama">

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        </div>
    </div>
</div>

@endsection

@push('script_processing')
<script>

    $('#jabatan').change(function(){
        var element = $(this).find('option:selected');
        var jns_jabatan = element.attr("jns_struktur");
        // console.log(jns_jabatan);
        if(jns_jabatan == 'JF'){
            return $('#jafung_field').removeClass('d-none');
        }
        $('#jafung_field').addClass('d-none');
    })

    $('.select2').select2();

    $(".flatpicker").flatpickr({
        dateFormat: "Y-m-d",
    });

    $(document).on('change', '.btn-file :file', function() {
		var input = $(this),
			label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
		input.trigger('fileselect', [label]);
	});

    $('.btn-file :file').on('fileselect', function(event, label) {

        var input = $(this).parents('.input-group').find(':text'),
            log = label;

        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }

    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });

    $('#simpan').click(function(){
        $('#form_pegawai').submit();
    })

    $('.preview').click(function(){
        // console.log($(this).attr('url'));
        var url = $(this).attr('url');
        var myModal = new bootstrap.Modal(document.getElementById('modal_file_preview'), {
                    keyboard: false
            });
        $('#frame_kerjasama').html('<p>Memuat Data Harap Tunggu ..........</p>');
        var iframe = ' <iframe src="'+url+'" width="100%" height="300px"></iframe>';
        $('#frame_kerjasama').html(iframe);
        myModal.show();
    })
</script>
@endpush
