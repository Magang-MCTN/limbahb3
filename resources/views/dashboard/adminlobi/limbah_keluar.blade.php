<!-- resources/views/dashboard/timlb3/limbah_keluar/index.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container py-3 px-4">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h3 class="fw-bold my-3">Data Limbah Keluar - {{ $periode->no_dokumen_keluar }}</h3>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Limbah</th>
                                        <th>Tujuan Penyerahan</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Jumlah Limbah B3 Keluar (KG)</th>
                                        <th>Sisa LB3 di TPS (Ton)</th>
                                        <th>Bukti Nomor Dokumen</th>
                                        <th>Jumlah Ton</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($limbahkeluar as $index => $limbah)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $limbah->jenisLimbah->jenis_limbah ?? '-' }}</td>
                                            <td>{{ $limbah->tujuanPenyerahan }}</td>
                                            <td>{{ $limbah->tanggal_keluar }}</td>
                                            <td>{{ $limbah->jumlahkg }}</td>
                                            <td>{{ $limbah->sisa_lb3 }}</td>
                                            <td>{{ $limbah->buktiNomorDokumen }}</td>
                                            <td>{{ $limbah->jumlahton }}</td>
                                        </tr>
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
