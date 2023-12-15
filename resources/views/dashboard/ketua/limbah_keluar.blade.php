<!-- resources/views/dashboard/timlb3/limbah_keluar/index.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container py-3 px-4">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h3 class="fw-bold">Data Limbah Keluar - {{ $periode->no_dokumen_keluar }}</h3>
    
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
                                    <tr></tr>
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
                                        <tr></tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex mt-3">
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
