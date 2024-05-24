<!DOCTYPE html>
<html>

<head>
    <title>SDM Indofood</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h2 class="text-center">Laporan Data Tunjangan Pegawai</h2>
    <p>Waktu : {{ $date }}</p>
    <table class="table table-bordered">
        <tr class="text-center">
            <th>Name</th>
            <th>Tunjangan</th>
            <th>Bulan</th>
            <th>Tahun</th>
            <th>Nominal</th>
            <th>Tanggal Diterima</th>
            <th>Status</th>
        </tr>
        @foreach($tunjangan as $items)
        <tr class="text-center">
            <td>{{ $items->pegawais->nama }}</td>
            <td>{{ $items->nama_tunjangan }}</td>
            <td>{{ $items->bulan }}</td>
            <td>{{ $items->tahun }}</td>
            <td>{{ $items->nominal }}</td>
            <td>{{ $items->tgl_diterima }}</td>
            <td>{{ $items->status }}</td>
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
