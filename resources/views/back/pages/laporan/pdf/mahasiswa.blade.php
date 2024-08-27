<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
    <style>
        * {
            box-sizing: border-box;
        }

        table {
            font-size: 14px;
        }

        .table {
            width: 100%;
            margin-top: 10px;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            vertical-align: top;
            border-top: 1px solid #dee2e6;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .table thead th {
            vertical-align: middle;
            border-bottom: 1px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 1px solid #dee2e6;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

    </style>
</head>

<body>
    <center>
        <h2>Laporan Seluruh Anggota UKM {{ $ukm }}</h2>
    </center>
    <table class="table table-bordered table-striped" style="text-align: center">
        <thead>
            <tr>
                <th>NPM</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Jurusan</th>
                <th>Angkatan</th>
                <th>Alamat</th>
                <th>Whatsapp</th>
                <th>Tgl Bergabung</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $item)
                <tr>
                    <td>{{ $item->user->npm }}</td>
                    <td>{{ $item->user->nama_lengkap }}</td>
                    <td>{{ $item->user->jenis_kelamin }}</td>
                    <td>{{ $item->user->getJurusan->nama_jurusan }}</td>
                    <td>{{ $item->user->angkatan }}</td>
                    <td>{{ $item->user->alamat }}</td>
                    <td>{{ $item->user->whatsapp }}</td>
                    <td>{{ date('d-m-Y H:i:s', strtotime($item->created_at)) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br> <br>

    <table style="width: 100%">
        <tr>
            <td style="text-align: right; font-size: 17px;">Medan, {{ date('d-m-Y') }}</td>
        </tr>
        <tr>
            <td style="text-align: right; font-size: 17px;">Penanggung Jawab</td>
        </tr>
        <tr>
            <td style="text-align: right; font-size: 17px;"><br><br><br></td>
        </tr>
        <tr>
            <td style="text-align: right; font-size: 17px;">(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)</td>
        </tr>
    </table>
</body>

</html>
