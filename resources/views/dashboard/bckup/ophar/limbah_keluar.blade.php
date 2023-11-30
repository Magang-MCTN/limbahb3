<!-- resources/views/dashboard/timlb3/limbah_keluar/index.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="container">
    <h2>Data Limbah Keluar - {{ $periode->no_dokumen_keluar }}</h2>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Jenis Limbah</th>
                    <th>Tujuan Penyerahan</th>
                    <th>Tanggal Keluar</th>
                    <th>Jumlah Limbah B3 Keluar (KG)</th>
                    <th>Sisa LB3 di TPS (Ton)</th>
                    <th>Bukti Nomor Dokumen</th>
                    <th>Jumlah Ton</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($limbahkeluar as $limbah)
                    <tr>
                        <td>{{ $limbah->id_limbah_keluar }}</td>
                        <td>{{ $limbah->jenisLimbah->jenis_limbah ?? '-' }}</td>
                        <td>{{ $limbah->tujuanPenyerahan }}</td>
                        <td>{{ $limbah->tanggal_keluar }}</td>
                        <td>{{ $limbah->jumlahkg }}</td>
                        <td>{{ $limbah->sisa_lb3 }}</td>
                        <td>{{ $limbah->buktiNomorDokumen }}</td>
                        <td>{{ $limbah->jumlahton }}</td>
                        <td>
                            <!-- Tambahkan tombol aksi di sini jika diperlukan -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
