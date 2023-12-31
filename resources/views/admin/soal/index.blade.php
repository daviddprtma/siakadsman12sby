@extends('layouts.soal')
@section('title', 'Data Ulangan')
@section('breadcrumb')
  <h1>Data Ulangan</h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Soal</li>
  </ol>
@endsection
@section('content')
<div class="col-md-12">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Paket soal</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
    	<button type="button" id="btn-soal" class="btn btn-primary btn-md"><i class="fa fa-pencil-square-o"></i> &nbsp;Tulis Soal</button>
    	<a href="{{ url('/download-file-format/soal') }}" class="btn btn-success btn-md"><i class="fa fa-file-excel-o"></i> &nbsp;Download Format Excel</a>
    	<button type="button" id="btn-upload-soal" class="btn btn-info btn-md"><i class="fa fa-cloud-upload"></i> &nbsp;Upload Excel</button>
      <div class="well" style="margin-top: 15px; display: none;" id="wrap-soal">
        <form class="form-horizontal" id="formSoal">
          {{ csrf_field() }}
          <input type="hidden" name="id" value="N">
          <div class="box-body">
            <div class="form-group">
              <label for="tipe_ulangan" class="col-sm-2 control-label">Tipe Ulangan</label>
              <div class="col-sm-4">
                <select name="tipe_ulangan" class="form-control">
                  <option value="">Pilih jenis soal</option>
                  <option value="UH1">Ulangan Harian 1</option>
                  <option value="UH2">Ulangan Harian 2</option>
                  <option value="UH3">Ulangan Harian 3</option>
                  <option value="UTS">Ulangan Tengah Semester</option>
                  <option value="UAS">Ulangan Akhir Semester</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="mapels_id" class="col-sm-2 control-label">Materi</label>
              <div class="col-sm-4">
                <select name="mapels_id" class="form-control">
                  <option value="">Pilih materi</option>
                  @if($mapels->count())
                  @foreach($mapels as $mapel)
                  <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                  @endforeach
                  @endif
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="waktu" class="col-sm-2 control-label">Waktu</label>
              <div class="col-sm-2">
                <input type="text" class="form-control numOnly" data-toggle="tooltip" title="Masukan waktu ujian dalam satuan menit" name="waktu" placeholder="60">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <div id="wrap-btn">
                  <button type="button" class="btn btn-danger" id="btnbatal">Batal</button>
                  <button type="button" class="btn btn-info" id="btnSimpan">Simpan</button>
                </div>
                <div id="notif" style="display: none; margin-top: 15px"></div>
              </div>
            </div>
            <div class="overlay" id="loading" style="display: none;"><i class="fa fa-refresh fa-spin" ></i></div>
          </div>
        </form>
      </div>
      <div class="well" style="margin-top: 15px; display: none;" id="wrap-upload-soal">
        <form class="form-horizontal" action="{{ url('/crud/simpan-detail-soal-via-excel') }}" enctype="multipart/form-data" method="POST">
          {{ csrf_field() }}
          <div class="box-body">
            <div class="form-group">
              <input type="file" name="file" id="file" class="inputfile" />
              <label for="file"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Pilih file excel</label>
              <p class="help-block">Silahkan pilih file format soal dalam bentuk excel yang telah diisi dengan benar.</p>
            </div>
            <div class="box-footer">
              <input class="btn btn-danger" id="batal-upload" type="button" value="Batal" />
              <input class="btn btn-primary" name="upload" type="submit" value="Import" />
            </div>
          </div>
        </form>
      </div>
    	<hr style="margin: 10px 0 15px 0">
      <table class="table table-hover table-striped" id="table_soal">
        @php
            $bulan = date('m');
            $tahun = date('Y');
        @endphp
      	@if (Auth::user()->roles == 'Guru' || Auth::user()->roles == 'Admin' )
            <label for="">Tahun Ajaran</label>
            &nbsp;
            <select name="" id="tahunajaran">
                <option value="">Pilih Tahun Ajaran</option>
                <option value="">
                    @if ($bulan > 6)
                                {{ 'Semester Ganjil' }}
                            @else
                                {{ 'Semester Genap' }}
                    @endif
                    @if ($bulan > 6)
                                {{ $tahun }}/{{ $tahun+1 }}
                            @else
                                {{ $tahun-1 }}/{{ $tahun }}
                    @endif
                </option>
            </select>
            &nbsp;
            <button id="show">Tampilkan</button>
	        <caption>Data paket soal yang Anda buat</caption>
        @else
        	<caption>Data paket soal</caption>
        @endif
        <thead>
          <tr>
            <th>ID Soal</th>
            <th style="text-align: center;">Tipe Ulangan</th>
            <th style="text-align: center;">Materi</th>
            <th style="text-align: center;">Tahun Ajaran</th>
            <th style="text-align: center; width: 70px">Waktu</th>
            <th style="text-align: center; width: 100px">Aksi</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
@endsection
@push('css')
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/media/css/dataTables.bootstrap.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/extensions/Responsive/css/responsive.dataTables.css')}}">
  <link rel="stylesheet" href="{{URL::asset('assets/plugins/datatables/extensions/FixedHeader/css/fixedHeader.bootstrap.css')}}">
  <style type="text/css">
    .panel {
      margin-bottom: 5px !important;
    }
    .form-group {
      margin-bottom: 5px;
    }
    .inputfile {
      width: 0.1px;
      height: 0.1px;
      opacity: 0;
      overflow: hidden;
      position: absolute;
      z-index: -1;
    }
    .inputfile + label {
      font-size: 1.25em;
      font-weight: 700;
      color: white;
      background-color: green;
      display: inline-block;
      padding: 10px;
    }
    .inputfile:focus + label,.inputfile + label:hover {
      background-color: darkgreen;
    }
    .inputfile + label {
      cursor: pointer;
    }
    .inputfile:focus + label {
      outline: 1px dotted #000;
      outline: -webkit-focus-ring-color auto 5px;
    }
    .inputfile + label * {
      pointer-events: none;
    }
  </style>
@endpush
@push('scripts')
<script src="{{URL::asset('assets/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.js')}}"></script>
<script>
$(document).ready(function (){
  table_soal = $('#table_soal').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    lengthChange: true,
    ajax: {
      url: '{!! route('elearning.get-soal') !!}',
    },
    columns: [
      {data: 'id', name: 'id', orderable: true, searchable: true },
      {data: 'tipe_ulangan', name: 'tipe_ulangan', orderable: true, searchable: true },
      {data: 'nama_mapel', name: 'nama_mapel', orderable:true, searchable:true},
      {data: 'created_at', name: 'created_at', orderable: true, searchable: true, visible: false },
      {data: 'waktu', name: 'waktu', orderable: true, searchable: true },
      {data: 'action', name: 'action', orderable: false, searchable: false, },
    ],
    "drawCallback": function (setting) {}
  });
    $('#show').click(function () {
        var tahunajaran = $('#tahunajaran').val();
        $('#table_soal').DataTable().ajax.reload();
   })
  $("#btn-upload-soal").click(function() {
    $("#wrap-soal").hide();
    $("#wrap-upload-soal").slideToggle();
  })
  $("#batal-upload").click(function() {
    $("#wrap-upload-soal").slideToggle();
  })
  $("#btn-soal").click(function() {
    $("#wrap-upload-soal").hide();
    $("#wrap-soal").slideToggle();
  })
  $("#btnbatal").click(function() {
    $("#wrap-soal").slideToggle();
  })
  $("#btnSimpan").click(function(){
    $("#wrap-btn").hide();
    $("#loading").show();
    var dataString = $("#formSoal").serialize();
    $.ajax({
      type: "POST",
      url: "{{ url('/crud/simpan-soal') }}",
      data: dataString,
      success: function(data){
        console.log(data);
        if (data == 'ok') {
          $("#loading").hide();
          $("#wrap-btn").show();
          $("#notif").removeClass('alert alert-danger').addClass('alert alert-info').html("<i class='fa fa-info-circle'></i> Data berhasil disimpan.").fadeIn(350);
          window.location.href = "{{ url('/soal') }}";
        }else{
          $("#loading").hide();
          $("#wrap-btn").show();
          $("#notif").removeClass('alert alert-info').addClass('alert alert-danger').html(data).fadeIn(350);
        }
      }
    })
  });
});
</script>
@endpush
