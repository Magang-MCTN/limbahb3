<!DOCTYPE html>
<html lang="en">
<!-- ... (Sesuaikan bagian head, title, dan style) ... -->
<head>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 10px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .ttd {
            width: 100%;
            text-align: left;
            margin-top: 35px;
        }
        .ttd .isi {
            width: 50%;
            margin-left: 550px;
        }

        .nama {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    @php
        $totalData = count($neraca1);
        $totalDihasilkan = 0;
    @endphp
    @foreach ($bulanData as $dataBulan)
        <h1 style="text-align: center;">NERACA LIMBAH BAHAN BERBAHAYA DAN BERACUN</h1>
        <h2>Nama Perusahaan : PT. PLN Mandau Cipta Tenaga Nusantara</h2>
        <h2>Bidang Usaha : Pembangkit Listrik</h2>
        <h2>Periode Waktu : {{ $dataBulan['namaBulan'] }}</h2>
        <!-- Data Neraca -->

        <table>
            <thead>
                <tr>
                    <th>I</th>
                    <th>Jenis Awal Limbah</th>
                    <th>Jumlah (Ton)</th>
                    <td rowspan="{{$totalData + 2}}" colspan="5" style="vertical-align: text-top;"><b>Catatan: </b><br><br>{{$dataBulan['neraca2']->catatan}}</td>
                </tr>

            </thead>
            <tbody>
                @php
                    $totalDisimpan = 0; $totalDimanfaatkan = 0; $totalDiolah = 0; $totalDitimbun = 0; $totalDiserahkan = 0; $totalExport = 0; $totalLainnya = 0;
                @endphp
                @foreach ($dataBulan['neraca1'] as $index => $data)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $data->jenisLimbah->jenis_limbah }}</td>
                        <td>{{ $data->dihasilkan}}</td>
                        @php
                            $totalDihasilkan += $data->dihasilkan;

                            $totalDisimpan += $data->disimpan;
                            $totalDimanfaatkan += $data->dimanfaatkan;
                            $totalDiolah += $data->diolah;
                            $totalDitimbun += $data->ditimbun;
                            $totalDiserahkan += $data->diserahkan;
                            $totalExport += $data->export;
                            $totalLainnya += $data->lainnya;
                        @endphp

                        <!-- ... (Kolom-kolom lainnya) ... -->
                    </tr>
                @endforeach
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td>{{$totalDihasilkan}}</td>
                    </tr>
                    <tr>
                        <th rowspan="2">II</th>
                        <th rowspan="2">Perlakuan</th>
                        <th rowspan="2">Jumlah (Ton)</th>
                        <th rowspan="2">Jenis Limbah yang Dikelola</th>
                        <th rowspan="2">Dokumen Kontrol</th>
                        <th colspan="3">Perizinan Limbah Dari KLH</th>
                    </tr>
                    <tr>
                        <th>Ada</th>
                        <th>Tidak</th>
                        <th>Kadalularsa</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Disimpan</td>
                        <td>{{$totalDisimpan}}</td>
                        <td></td>
                        <td rowspan="7">{{$dataBulan['neraca2']->dokumen_kontrol}}</td>
                        @if ($dataBulan['neraca2']->perizinan_limbah_klh == 'ada')
                            <td rowspan="7">{{$dataBulan['neraca2']->no_izin_limbah_klh}}</td>
                            <td></td>
                            <td></td>
                        @elseif ($dataBulan['neraca2']->perizinan_limbah_klh == 'tidak')
                            <td></td>
                            <td rowspan="7">{{$dataBulan['neraca2']->no_izin_limbah_klh}}</td>
                            <td></td>
                        @else
                            <td></td>
                            <td></td>
                            <td rowspan="7">{{$dataBulan['neraca2']->no_izin_limbah_klh}}</td>
                        @endif
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Dimanfaatkan</td>
                        <td>{{$totalDimanfaatkan}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Diolah</td>
                        <td>{{$totalDiolah}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Ditimbun</td>
                        <td>{{$totalDitimbun}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Diserahkan ke Pihak III</td>
                        <td>{{$totalDiserahkan}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Export</td>
                        <td>{{$totalExport}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Lainnya</td>
                        <td>{{$totalLainnya}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @php
                        $total = $totalDihasilkan + $totalDisimpan + $totalDimanfaatkan + $totalDiolah + $totalDitimbun + $totalDiserahkan + $totalExport + $totalLainnya;
                    @endphp
                    <tr>
                        <td></td>
                        <td>Total</td>
                        <td>{{$total}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Residu</td>
                        <td colspan="6">{{ $dataBulan['neraca2']->residu }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Jumlah Limbah yang Belum Terkelola</td>
                        <td colspan="6">{{ $dataBulan['neraca2']->limbah_belum_dikelola }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Jumlah Limbah yang Tersisa</td>
                        <td colspan="6">{{ $dataBulan['neraca2']->limbah_tersisa }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Kinerja Pengelolaan Limbah B3 Selama Periode Skala Waktu Tertentu</td>
                        <td colspan="6">{{ $dataBulan['neraca2']->kinerja_pengelolaan }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="7"><b>Keterangan:</b> <br><br>
                            *RESIDU adalah jumlah dari proses perlakuan seperti abu insenerator, botton ash dan atau fly ash dari pemanfaatan sludge oil boiler, residu dari penyimpanan dan pengumpulan oli bekas dll <br>

                            ** Jumlah limbah yang belum terkelola adalah limbah yang disimpan melebihi skala waktu penataan
                        </td>
                    </tr>
            </tbody>
        </table>
        <p>Data-data tersebut diatas diisi dengan sebenar-benarnya sesuai dengan kondisi yang ada.</p>
        <div class="ttd">
            <div class="isi">
                <p>Mengetahui:</p>

                <p>{{ $formattedDate  }}</p>
                <br>
                <img src="{{ public_path('storage/'.$ttd) }}" alt="Tanda Tangan" width="90">

                <br>
                <p class="nama">Radpandji Edi Widjaja </p>
                <p>Direktur AsOpHar MCTN </p>
            </div>
        </div>

        <div style="page-break-before:{{ $loop->last ? 'auto' : 'always' }}">&nbsp;</div> <!-- Untuk membuat halaman baru -->
        <!-- ... (Bagian body sesuai kebutuhan) ... -->

        @endforeach

</body>
</html>

