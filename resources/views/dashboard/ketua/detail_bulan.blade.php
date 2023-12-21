<!-- resources/views/dashboard/timlb3/detail_bulan.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h3 class="fw-bold">Detail Laporan Neraca</h3>

                    <table class="table">
                        <tr>
                            <th>No Dokumen Masuk</th>
                            <td>{{ $periode->no_dokumen_masuk }}</td>
                        </tr>
                        <tr>
                            <th>Nama Laporan</th>
                            <td>Neraca Limbah B3</td>
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
                        <tr></tr>
                    </table>

                    <table class="table text-center mt-4">
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
                                        <a href="{{ route('ketua.lihatNeracaPerbulan', ['id_bulan' => $bulan->id_bulan]) }}" class="btn btn-info">Lihat Detail Neraca</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                        <a href="{{ route('export.neraca.pdfnottd', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-primary">Unduh Laporan Neraca</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
