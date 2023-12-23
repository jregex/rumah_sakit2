<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
</head>
<body>
    <table border="1" cellpadding="3" cellspacing="2" align="center">
        <thead>
            <tr>
                <th>No</th>
                <th>Ruangan</th>
                <th>Dokter</th>
                <th>Pasien</th>
                <th>Tanggal</th>
                <th>Jam mulai</th>
                <th>Jam selesai</th>
            </tr>
        </thead>
        <tbody style="text-align: center">
            @foreach ($jadwals as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->ruangan->no_ruangan }}</td>
                <td>{{ $item->dokter->nama_dokter }}</td>
                <td>{{ $item->pasien->nama_pasien }}</td>
                <td>{{ date('d/m/Y',strtotime($item->tgl)) }}</td>
                <td>{{ date('H:i',strtotime($item->jam_mulai)) }}</td>
                <td>{{ date('H:i',strtotime($item->jam_selesai)) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
