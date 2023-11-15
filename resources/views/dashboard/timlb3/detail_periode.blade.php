<!-- resources/views/dashboard/timlb3/detail_periode.blade.php -->

@extends('dashboard.app')

@section('content')
    <div class="container">
        <h2>Detail Periode Laporan</h2>

        <table class="table">
            <tr>
                <th>No Dokumen Masuk</th>
                <td>{{ $periode->no_dokumen_masuk }}</td>
            </tr>
            <tr>
                <th>Nama Laporan</th>
                <td>Limbah Masuk</td>
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
                <td>{{ $periode->status ? $periode->status->nama : 'Tidak Ada Status' }}</td>
            </tr>
            <tr>
                <th>Alasan</th>
                <td>{{ $periode->alasan ?: 'Belum Ada' }}</td>
            </tr>
        </table>
    </div>
@endsection
