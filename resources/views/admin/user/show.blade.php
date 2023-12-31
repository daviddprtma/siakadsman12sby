@extends('template_backend.home')
@section('heading')
  Data User @foreach ($role as $d => $data) {{ $d }} @endforeach
@endsection
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('user.index') }}">User</a></li>
  @foreach ($role as $d => $data)
    <li class="breadcrumb-item active">{{ $d }}</li>
  @endforeach
@endsection
@section('content')
<div class="col-md-12">
  <div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <a href="{{ route('user.index') }}" class="btn btn-default btn-sm"><i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</a>
        </h3>
    </div>
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Depan</th>
                <th>Nama Belakang</th>
                <th>Nama Pengguna</th>
                <th>Email</th>
                @foreach ($role as $d => $data)
                  @if ($d == 'Guru')
                    <th>NIP</th>
                  @elseif ($d == 'Siswa')
                    <th>No Induk Siswa</th>
                  @else
                  @endif
                @endforeach
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
          @if ($user->count() > 0)
            @foreach ($user as $data)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td class="text-capitalize">{{ $data->nama_depan }}</td>
                <td class="text-capitalize">{{ $data->nama_belakang }}</td>
                <td class="text-capitalize">{{ $data->nama_pengguna }}</td>
                <td>{{ $data->email }}</td>
                @if ($data->roles == 'Siswa')
                  <td>{{ $data->nis }}</td>
                @elseif ($data->roles == 'Guru')
                  <td>{{ $data->nip}}</td>
                @else
                @endif
                {{-- <td>{{ $data->created_at->format('l, d F Y') }}</td> --}}
                <td>
                  <form action="{{ route('user.destroy', $data->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger btn-sm" onclick="if(!confirm('apakah anda yakin untuk menghapus nama {{$data->nama_depan. ' '. $data->nama_belakang}} ini?')) return false;"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                  </form>
                </td>
              </tr>
            @endforeach
          @else
            <tr>
              <td colspan='5' style='background:#fff;text-align:center;font-weight:bold;font-size:18px;'>Silahkan Buat Akun Terlebih Dahulu!</td>
            </tr>
          @endif
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataUser").addClass("active");
    </script>
@endsection