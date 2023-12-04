<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pelaksanaan Pengelolaan Limbah B3</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            text-align: justify;
            margin-bottom: 20px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Pelaksanaan Pengelolaan Limbah B3</h2>
        <p>Lapangan Gas Turbin Duri-PT. Mandau Cipta Tenaga Nusantara</p>
    </div>

    <div class="content">
        <p>Dengan hormat,</p>
        <p>Dalam upaya melaksanakan pengelolaan Limbah B3 yang dihasilkan dari kegiatan operasional North Duri Cogeneration Plant – PT. Mandau Cipta Tenaga Nusantara dan untuk memenuhi persyaratan dalam Izin Penyimpanan Sementara Limbah Bahan Berbahaya dan Beracun No. 061/DPMPSP-Pzn-ttt/2019/31 dari Bupati Kab. Bengkalis, bersama ini kami sampaikan Laporan Neraca Limbah B3, bukti pelaporan SIMPEL dan realisasi kegiatan penyimpanan sementara limbah bahan berbahaya dan beracun untuk Kuartal {{ $kuartal }} Tahun {{ $tahun }}.</p>
        <p>Demikian laporan ini kami sampaikan. Atas kerjasamanya, kami ucapkan terima kasih.</p>
    </div>

    <div class="footer">
        <p>{{ now()->format('d F Y') }}</p>
        <p>Tertanda,</p>
        <!-- Gantilah dengan tanda tangan yang sesuai -->
        <img src="{{ public_path('path/to/tanda_tangan.jpg') }}" alt="Tanda Tangan" width="100">
        <p>Radpandji Edy Widjaja </p><br>
        <p>Direktur AsOpHar MCTN </p>
    </div>
</body>
</html>
