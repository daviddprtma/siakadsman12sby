<!DOCTYPE html>
<html>
<head>
	<title>Nilai Rapor Siswa</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
</head>
<body>
<div class="container-fluid py-4">
    <h2 style="text-align: center;">Nilai Rapor {{Auth::user()->nama_depan}} {{Auth::user()->nama_belakang}} </h2>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0" border="0.5">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Mata Pelajaran</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        KKM
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Nilai
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Predikat
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai as $n)
                                <tr>
                                    <td class="align-middle text-sm">
                                        <span class="text-xs font-weight-bold" >{{ $n->mapel['nama_mapel'] }}</span>
                                    </td>

                                    <td class="align-middle text-sm">
                                        <span class="text-xs font-weight-bold">75</span>
                                        </span>
                                    </td>

                                    <td class="align-middle text-sm">
                                        <span class="text-xs font-weight-bold">{{ round($n->nilai_rapor,2) }}</span>
                                        </span>
                                    </td>

                                    <td class="align-middle text-sm">
                                        @if ( $n->nilai($n['id'])['nilai_rapor ']> 88)
                                        <div class="text-xs font-weight-bold">A (Sangat Baik)</div>
                                       @elseif ( $n->nilai($n['id'])['nilai_rapor'] > 79 && $n->nilai($n['id'])['nilai_rapor'] <=88)
                                        <div class="text-xs font-weight-bold">B (Baik)</div>
                                        @elseif ( $n->nilai($n['id'])['nilai_rapor'] > 70 && $n->nilai($n['id'])['nilai_rapor'] <=79)
                                        <div class="text-xs font-weight-bold">C (Cukup)</div>
                                        @else
                                        <div class="text-xs font-weight-bold">D (Kurang)</div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</body>
</html>
