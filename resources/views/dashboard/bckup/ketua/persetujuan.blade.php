<!-- resources/views/dashboard/ophar/index.blade.php -->

@extends('dashboard.app')

@section('content')
    <div class="container">
        <h2>Persetujuan Laporan Limbah</h2>

        <table class="table">
            <thead>
                <tr>
                    {{-- <th>No Dokumen Masuk</th> --}}
                    <th>Kuartal</th>
                    <th>Tahun</th>
                    <th>Status Limbah Masuk</th>
                    <th>Status Limbah Keluar</th>
                    <th>Status Limbah Neraca</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($periodes as $periode)
                    {{-- @if ($periode->status && $periode->status->id_status == 2) --}}
                        <tr>
                            {{-- <td>{{ $periode->no_dokumen_masuk }}</td> --}}
                            <td>{{ $periode->kuartal }}</td>
                            <td>{{ $periode->tahun }}</td>
                            <td>{{ $periode->status ? $periode->status->nama : 'Belum Ada Status' }}</td>
                            <td>{{ $periode->statuskeluar ? $periode->statuskeluar->nama : 'Belum Ada Status' }}</td>
                            <td>{{ $periode->statusNeraca ? $periode->statusNeraca->nama : 'Belum Ada Status' }}</td>
                            <td>
                                <a href="{{ route('ketua.show', $periode->id_periode_laporan) }}" class="btn btn-info">Detail</a>
                            </td>
                        </tr>
                    {{-- @endif --}}
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

@endsection
