@extends('template_backend.home')
@section('heading', 'Data Jadwal')
@section('page')
  <li class="breadcrumb-item active">Data Jadwal</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
      <div class="card-header">
          <h3 class="card-title">
              <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target=".tambah-jadwal">
                  <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Jadwal
              </button>
          </h3>
      </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Kelas</th>
                    <th>Tipe Kelas</th>
                    <th>Lihat Jadwal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas as $data)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->kelas }}</td>
                    <td>{{$data->tipe_kelas}}</td>
                    <td>
                      <a href="{{ route('jadwal.show', Crypt::encrypt($data->id)) }}" class="btn btn-info btn-sm"><i class="nav-icon fas fa-search-plus"></i> &nbsp; Ditails</a>
                    </td>
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

<!-- Extra large modal -->
<div class="modal fade bd-example-modal-lg tambah-jadwal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title">Tambah Data Jadwal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <form action="{{ route('jadwal.store') }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="haris_id">Hari</label>
                  <select id="haris_id" name="haris_id" class="form-control @error('haris_id') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Hari --</option>
                      @foreach ($hari as $data)
                          <option value="{{ $data->id }}">{{ $data->nama_hari }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="kelas_id">Kelas</label>
                  <select id="kelas_id" name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Kelas --</option>
                      @foreach ($kelas as $data)
                          <option value="{{ $data->id }}">{{ $data->kelas }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="kelas_id">Tipe Kelas</label>
                  <select id="kelas_id" name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Tipe Kelas --</option>
                      @foreach ($kelas as $data)
                          <option value="{{ $data->id }}">{{ $data->tipe_kelas }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="mapels_id">Mapel</label>
                  <select id="mapels_id" name="mapels_id" class="form-control @error('mapels_id') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Mapel --</option>
                      @foreach ($mapel as $data)
                          <option value="{{ $data->id }}">{{ $data->nama_mapel }}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="jam_mulai">Jam Mulai</label>
                  <input type='text' id="jam_mulai" name='jam_mulai' class="form-control @error('jam_mulai') is-invalid @enderror jam_mulai" placeholder="{{ Date('H:i') }}">
                </div>
                <div class="form-group">
                  <label for="jam_selesai">Jam Selesai</label>
                  <input type='text' id="jam_selesai" name='jam_selesai' class="form-control @error('jam_selesai') is-invalid @enderror" placeholder="{{ Date('H:i') }}">
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
              <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Tambahkan</button>
          </form>
          </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataJadwal").addClass("active");
        $("#jam_mulai,#jam_selesai").timepicker({
            timeFormat: 'HH:mm'
        });
    </script>
@endsection