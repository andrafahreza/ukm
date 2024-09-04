<!DOCTYPE html>
<html>

<head>
    <title>Kartu Anggota</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .kartu-peserta-seleksi {
            padding: 16px;
            width: 415px;
            border: 1px solid black;
        }

        .kartu-peserta-seleksi p {
            font-size: 8pt;
        }

        .kartu-peserta-seleksi td,
        .kartu-peserta-seleksi .footer-wrapper p {
            font-size: 9.5pt;
        }

        .kartu-peserta-seleksi .head-wrapper {
            display: flex;
            padding: 8pt;
            flex-direction: row;
            margin: -16px -16px 0;
            align-items: center;
            justify-content: center;
            border-bottom: 2px solid black;
        }

        .kartu-peserta-seleksi .head-wrapper .sec {
            width: 60px;
            text-align: center;
        }

        .kartu-peserta-seleksi .head-wrapper .sec:nth-child(2) {
            flex: 1;
        }

        .kartu-peserta-seleksi .head-wrapper img {
            height: 50px;
        }

        .kartu-peserta-seleksi .head-wrapper .sec:last-child {
            font-weight: 900;
        }

        .kartu-peserta-seleksi .head-wrapper .sec:nth-child(-1n+3) p {
            margin-bottom: 0;
        }

        .kartu-peserta-seleksi .head-wrapper .sec:nth-child(2) p:nth-child(-n+3) {
            font-weight: bold
        }

        .kartu-peserta-seleksi .content-wrapper {
            padding: 16px 0;
        }


        .kartu-peserta-seleksi .content-wrapper tr:nth-last-child(-n+2) td:last-child {
            color: blue;
        }

        .kartu-peserta-seleksi .content-wrapper tr td:nth-child(2) {
            width: 15px;
            text-align: center;
        }

        .kartu-peserta-seleksi .footer-wrapper {
            text-align: right;
        }

        .kartu-peserta-seleksi .footer-wrapper p {
            margin-bottom: 0
        }
    </style>
</head>

<body>
    <div class="kartu-peserta-seleksi-wrapper">
        <center>
            <div class="kartu-peserta-seleksi">
                <div class="head-wrapper">
                    <center>
                        <h5>Kartu Anggota</h5>
                    </center>
                </div>
                <div class="content-wrapper">
                    <table>
                        <tbody>
                            <tr>
                                <td>Unit Kegiatan Mahasiswa</td>
                                <td>:</td>
                                <td><strong>{{ $data->ukm->ukmNama }}</strong></td>
                            </tr>
                            <tr>
                                <td>NPM</td>
                                <td>:</td>
                                <td><strong>{{ $data->user->npm }}</strong></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td><strong>{{ $data->user->nama_lengkap }}</strong></td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td><strong>{{ $data->user->jenis_kelamin }}</strong></td>
                            </tr>
                            <tr>
                                <td>Jurusan</td>
                                <td>:</td>
                                <td><strong>{{ $data->user->getJurusan->nama_jurusan }}</strong></td>
                            </tr>
                            <tr>
                                <td>Angkatan</td>
                                <td>:</td>
                                <td><strong>{{ $data->user->angkatan }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="footer-wrapper">
                    <p>Medan, {{ date('d m Y') }}</p>
                    <p>Ketua UKM</p>
                    <br><br>
                    <p><strong>{{ $data->ukm->ketua }}</strong></p>
                </div>
            </div>
        </center>
    </div>
</body>

</html>
