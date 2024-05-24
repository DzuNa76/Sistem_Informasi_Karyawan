<!DOCTYPE html>
<html>

<head>
    <title>SDM Indofood</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h2 class="text-center">Laporan Data Evaluasi Kerja Pegawai</h2>
    <p>Waktu : {{ $date }}</p>
    <table class="table table-bordered">
        <tr class="text-center">
            <th>Nama</th>
            <th>Tanggal Evaluasi</th>
            <th>Nama Reviewer</th>
            <th>Nilai Kinerja</th>
            <th>Comments</th>
        </tr>
        @foreach($evaluasiKerja as $items)
        <tr class="text-center">
            <td>{{ $items->pegawais->nama }}</td>
            <td>{{ $items->tgl_evaluasi }}</td>
            <td>{{ $items->nama_reviewer }}</td>
            <td>{{ $items->nilai_kinerja }}</td>
            <td>{{ $items->comments}}</td>
        </tr>
        @endforeach
    </table>
    <div class="float-right">
        <p class="text-center">Malang, {{ $date }}</p>
        <p class="text-center">{{session('user.role') }}</p>
        <br><br><br>
        <p class="text-center">{{ session('user.nama') }}</p>
    </div>
</body>
</html>
