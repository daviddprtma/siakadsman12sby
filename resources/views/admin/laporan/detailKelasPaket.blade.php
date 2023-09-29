@extends('layouts.soal')
@section('title', 'Laporan Nilai Ulangan')
@section('breadcrumb')
  <h1>Laporan</h1>
  <ol class="breadcrumb">
    <li><a href="{{ url('/home') }}"><i class="fa fa-home"></i> Home</a></li>
    <li class="active">Laporan Nilai Ulangan</li>
  </ol>
@endsection
@section('content')
<?php include(app_path().'/functions/myconf.php'); ?>
<div class="col-md-12">
  <div class="box box-primary">
  	<div class="box-header with-border">
      <h3 class="box-title">Laporan paket soal {{ $soal->mapel->nama_mapel }} kelas {{ $kelas->kelas }} {{ $kelas->tipe_kelas }} </h3>
    </div>
    <div class="box-body">
      <table class="table table-condensed table-hover" id="table_detail">
        <caption><i>Siswa yang mengerjakan paket soal <small>{{ $soal->mapel->nama_mapel }}</small></i></caption>
        <thead>
          <tr>
            <th>Nama Depan</th>
            <th>Nama Belakang</th>
            <th>Nilai</th>
            <th style="text-align: center;">Aksi</th>
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
@endpush
@push('scripts')
<script src="{{URL::asset('assets/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatables/extensions/FixedHeader/js/dataTables.fixedHeader.js')}}"></script>
<script>
$(document).ready(function (){
  table_paket_soal = $('#table_detail').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    lengthChange: true,
    ajax: {
      url: '{!! route('elearning.laporan.data_kelas_paket_soal') !!}',
      data: {"ulangans_id": '{{ $jawaban[0]['ulangans_id'] }}'},
    },
    columns: [
      {data: 'nama_depan', name: 'nama_depan', orderable: true, searchable: true },
      {data: 'nama_belakang', name: 'nama_belakang', orderable: true, searchable: true },
      {data: 'jumlah_nilai', name: 'jumlah_nilai', orderable: true, searchable: true },
      {data: 'action', name: 'action', orderable: false, searchable: false, },
    ],
    "drawCallback": function (setting) {}
  });
});
</script>
@endpush
