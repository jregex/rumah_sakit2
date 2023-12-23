<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h5 class="fw-bold bg-primary text-dark mb-3">Jadwal</h5>
        <ul>
            <li class="fs-5"><i class="caret-right"></i>Tanggal : {{date('l, d-m-Y',strtotime($jadwals->tgl))}}</li>
            <li class="fs-5"><i class="caret-right"></i>Jam : {{date('H:i',strtotime($jadwals->jam_mulai))}}</li>
            <li class="fs-5"><i class="caret-right"></i>Ruangan : {{$jadwals->ruangan->no_ruangan}}</li>
        </ul>
        <h5 class="fw-bold bg-primary text-dark mb-3">Pasien</h5>
        <ul>
            <li class="fs-5"><i class="caret-right"></i>Nama : {{$jadwals->pasien->nama_pasien}}</li>
            <li class="fs-5"><i class="caret-right"></i>Tanggal lahir : {{date('l, d-m-Y',strtotime($jadwals->pasien->tgllahir))}}</li>
            <li class="fs-5"><i class="caret-right"></i>Alamat : {{$jadwals->pasien->alamat}}</li>
            <li class="fs-5"><i class="caret-right"></i>Kontak : {{$jadwals->pasien->kontak}}</li>
        </ul>
        <h5 class="fw-bold bg-primary text-dark mb-3">Dokter</h5>
        <ul>
            <li class="fs-5"><i class="caret-right"></i>Nama : {{$jadwals->dokter->nama_dokter}}</li>
            <li class="fs-5"><i class="caret-right"></i>Kontak : {{$jadwals->dokter->kontak}}</li>
        </ul>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
