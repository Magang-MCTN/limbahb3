<!-- resources/views/dashboard/ophar/index.blade.php -->

@extends('dashboard.app')

@section('content')
    <div class="container">
        <h2>Persetujuan Laporan</h2>

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
                    <tr>
                        {{-- <td>{{ $periode->no_dokumen_masuk }}</td> --}}
                        <td>{{ $periode->kuartal }}</td>
                        <td>{{ $periode->tahun }}</td>
                        <td>{{ $periode->status ? $periode->status->nama : 'Belum Ada Status' }}</td>
                        <td>{{ $periode->statuskeluar ? $periode->statuskeluar->nama : 'Belum Ada Status' }}</td>
                        <td>{{ $periode->statusNeraca ? $periode->statusNeraca->nama : 'Belum Ada Status' }}</td>
                        <td>
                            <a href="{{ route('ophr.show', $periode->id_periode_laporan) }}" class="btn btn-info">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
