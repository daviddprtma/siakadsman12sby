@extends('template_backend.home')
@section('heading')
    Jadwal Kelas {{ $kelas->nama_kelas }}
@endsection
@section('page')
  <li class="breadcrumb-item active">Jadwal Kelas</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <a href="{{url('cetakjadwalpdf/')}}" class="btn btn-link text-dark px-3 mb-0">
                <i class="nav-icon fas fa-download"></i>
                <p>Cetak Jadwal</p>
            </a>
          <table id="example2" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Mata Pelajaran</th>
                    <th>Jam Pelajaran</th>
                    <th>Kelas</th>
                    <th>Tipe Kelas</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwal as $data)
                <tr>
                    <td>{{ $data->hari->nama_hari }}</td>
                    <td>
                        <h5 class="card-title">{{ $data->mapel->nama_mapel }}</h5>
                        <p class="card-text"><small class="text-muted">{{ $data->guru->nama_guru }}</small></p>
                    </td>
                    <td>{{ $data->jam_mulai }} - {{ $data->jam_selesai }}</td>
                    <td>{{ $data->kelas->kelas }}</td>
                    <td>{{ $data->kelas->tipe_kelas }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
@endsection
@section('script')
    <script>
        $("#JadwalSiswa").addClass("active");
    </script>
@endsection
