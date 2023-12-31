<!-- resources/views/dashboard/timlb3/detail_bulan.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
    <h2>Detail Laporan Neraca</h2>

    <table class="table">
        <tr>
            <th>No Dokumen Masuk</th>
            <td>{{ $periode->no_dokumen_masuk }}</td>
        </tr>
        <tr>
            <th>Nama Laporan</th>
            <td>Limbah Keluar</td>
        </tr>
        <tr>
            <th>Kuartal</th>
            <td>Kuartal {{ $periode->kuartal }}</td>
        </tr>
        <tr>
            <th>Keterangan Kuartal</th>
            <td>{{ $periode->keterangan_kuartal }}</td>
        </tr>
        <tr>
            <th>Tahun</th>
            <td>{{ $periode->tahun }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $periode->statuskeluar ? $periode->statuskeluar->nama : 'Tidak Ada Status' }}</td>
        </tr>
        <tr>
            <th>Alasan</th>
            <td>{{ $periode->alasan ?: 'Belum Ada' }}</td>
        </tr>
    </table>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Bulan</th>
                <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bulans as $bulan)
                <tr>
                    <td>{{ $bulan->nama_bulan }}</td>
                    <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                    <td>
                        <!-- Tambahkan tombol untuk melihat detail neraca perbulan -->
                        <a href="{{ route('admin.lihatNeracaPerbulan', ['id_bulan' => $bulan->id_bulan]) }}" class="btn btn-info">Lihat Detail Neraca</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-end mt-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
