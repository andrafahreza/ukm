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
            align-items: center;
            justify-content: center;
            margin-left: auto;
            margin-right: auto;
            margin-top: auto;
            margin-bottom: auto;
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
            align-items: center;
            justify-content: center;
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
                    <table border="0">
                        <tr>
                            <th style="padding: 5px">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRIBo-ib2ILFRqUA4rBhQMCtXUoJEJ8EzSF3z_thm21X4krlZMyfsOtDMIDXQRuMyFY3YM&usqp=CAU">
                            </th>
                            <th style="padding: 5px">
                                <h5>Universitas Katolik Santo Thomas Sumatera Utara <br> <small>Jalan Setia Budi No.479 F, Tanjung Sari</small></h5>
                            </th>
                        </tr>
                    </table>
                </div>
                <div class="content-wrapper">
                    <center>
                        <h5 style="font-size: 21px">Kartu Tanda <br> Anggota UKM</h5>
                    </center>
                    <table style="width: 100%; padding-left: 30px; padding-right: 30px">
                        <tbody>
                            <tr>
                                <td style="color: #000">{{ $data->user->nama_lengkap }} <br> {{ $data->user->getjurusan->nama_jurusan }} <br> {{ $data->ukm->ukmNama }}</td>
                                <td style="align-content: right">
                                    <img src="https://aurelia.my.id/{{ Auth::user()->photo }}" width="100" height="120">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </center>
    </div>
</body>

</html>
