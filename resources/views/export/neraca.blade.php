<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Neraca Limbah B3</title>
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
    </style>
</head>
<body>

    <h1 style="text-align: center;">NERACA LIMBAH BAHAN BERBAHAYA DAN BERACUN </h1>

    <div style="margin-bottom: 20px;">
        <p>Nama Perusahaan: PT. Mandau Cipta Tenaga Nusantara</p>
        <p>Bidang Usaha: Pembangkit Listrik</p>
        <p>Periode Waktu: {{ $namaBulans->implode(', ') }} {{ optional($periode)->tahun }}</p>
    </div>

    <!-- Tabel I: Jenis Awal Limbah -->
    <h2>I. Jenis Awal Limbah</h2>

    <table>
        <thead>
            <tr>
                <th>I</th>
                <th>Jenis Awal Limbah </th>
                <th>Jumlah (Ton) </th>
                <?php
                $totalData = count($neraca1);
                ?>
                <td colspan="6" rowspan="{{ $totalData+2 }}">Catatan : <br>asdasd <br>asdasd <br> asdasd <br></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($neraca1 as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data->id_jenis_limbah }}</td>
                    <td>{{ $data->dihasilkan }}</td>
                    {{-- <td colspan="6"></td> --}}
                </tr>
            @endforeach
            <tr>
                <td colspan="2">Total</td>
                <td>####</td>
            </tr>
            <tr>
                <th>II</th>
                <th>Perlakuan </th>
                <th>Jumlah (Ton) </th>
                <th>JENIS LIMBAH YANG DIKELOLA </th>
                <th>DOKUMEN KONTROL </th>
                <th>PERIZINAN LIMBAH DARI KLH </th>
                <th>ADA </th>
                <th>TIDAK</th>
                <th>KEDALUARSA</th>
            </tr>

            @foreach ($neraca1 as $index => $data)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>DISIMPAN</td>
                <td>{{ $data->disimpan }}</td>
                <td>{{ $data->dikelola }}</td>
                <td>{{ $data->dokumen_kontrol }}</td>
                <td>{{ $data->periizin_limbah_klh }}</td>

                @if ($index === 0)
                    <td rowspan="{{ $totalData }}">{{ $data->ada_tidak_kadaluarasa }}</td>
                    <td rowspan="{{ $totalData }}">{{ $data->ada_tidak_kadaluarasa }}</td>
                    <td rowspan="{{ $totalData }}">{{ $data->ada_tidak_kadaluarasa }}</td>
                @endif
                {{-- <td>{{ $data->keterangan_lainnya }}</td> --}}
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Keterangan -->
    <h3>KETERANGAN:</h3>
    <p>*RESIDU adalah jumlah dari proses perlakuan seperti abu insenerator, botton ash dan atau fly ash dari pemanfaatan sludge oil boiler, residu dari penyimpanan dan pengumpulan oli bekas dll</p>
    <p>** Jumlah limbah yang belum terkelola adalah limbah yang disimpan melebihi skala waktu penataan</p>

</body>
</html>
