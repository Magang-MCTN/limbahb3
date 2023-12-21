<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pelaksanaan Pengelolaan Limbah B3</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 20px;
            font-size: 15px;
        }

        .header {
            text-align: left;
            margin-bottom: 20px;
        }

        .content {
            text-align: justify;
            margin-bottom: 20px;
        }

        .footer {
            text-align: left;
            margin-top: 20px;
        }
        .kepada {
        	text-align: left;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .perihal span{
        	text-decoration: underline;
        }
        .lampiran {
            text-align: left;
            margin-top: 20px;
            margin-bottom: 20px;
            font-size: 12px;
        }

    </style>
</head>
<body>
    <div class="header">
        <p>Duri, {{ now()->format('d F Y') }}</p>
        <p>.../MCTN/ADM/X/2023</p>
    </div>

    <div class="kepada">
            Kepada Yth. <br>
            Kepala Pusat Pengendalian Pembangunan<br>
            Ekoregion Sumatera<br>
            Jln HR. Subrantas KM 10.5 Panam, Delima<br>
            Pekanbaru<br>
            Kota Pekanbaru, Riau 28289<br>
	</div>

    <div class="perihal">
    	<p>Perihal: <span>Laporan Pelaksanaan Pengelolaan Limbah B3 untuk Kuartal {{ $kuartal }} ({{$keterangan}}) {{$tahun}}</span><br>
        <span>Lapangan Gas Turbin Duri-PT. Mandau Cipta Tenaga Nusantara</span></p>
    </div>

    <div class="content">
        <p>Hormat kami,</p>
        <p>Dalam upaya melaksanakan pengelolaan Limbah B3 yang dihasilkan dari kegiatan operasional North Duri Cogeneration Plant – PT. Mandau Cipta Tenaga Nusantara dan untuk memenuhi persyaratan dalam Izin Penyimpanan Sementara Limbah Bahan Berbahaya dan Beracun No. 061/DPMPSP-Pzn-ttt/2019/31 dari Bupati Kab. Bengkalis, bersama ini kami sampaikan Laporan Neraca Limbah B3, bukti pelaporan SIMPEL dan realisasi kegiatan penyimpanan sementara limbah bahan berbahaya dan beracun untuk Kuartal {{ $kuartal }} ({{$keterangan}}) Tahun {{ $tahun }}.</p>
        <p>Demikian laporan ini kami sampaikan. Atas kerjasamanya, kami ucapkan terima kasih.</p>
    </div>

    <div class="footer">
        <p>Hormat kami,</p>
        <!-- Gantilah dengan tanda tangan yang sesuai -->
        {{-- <img src="{{ public_path('storage/'.$ttd) }}" alt="Tanda Tangan" width="100"> --}}
        <p style="text-decoration: underline;"><b>Radpandji Edy Widjaja</b></p>
        <p>Direktur AsOpHar MCTN </p>
    </div>

    <div class="lampiran">
        <p>Lampiran:</p>
        <ul>
            <li>Tanda Terima Elektronik Pemerintah Kabupaten Bengkalis </li>
            <li>Tanda Terima Elektronik Direktur Penilaian Kinerja Pengelolaan Limbah B3 dan Limbah Non B3 </li>
            <li>Tanda Terima Elektronik Pemerintah Daerah Provinsi Riau </li>
            <li>Tanda Terima Elektronik Kementrian Lingkungan Hidup dan Kehutanan  </li>
            <li>Lembar Kegiatan Limbah B3  </li>
            <li>Neraca Limbah B3 </li>
        </ul>
    </div>
</body>
</html>
