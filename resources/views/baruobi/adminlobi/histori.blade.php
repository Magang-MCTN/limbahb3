<!-- resources/views/dashboard/ophar/index.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container py-3 px-4">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h3 class="fw-bold">History Laporan Limbah</h3>
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        {{-- <th>No Dokumen Masuk</th> --}}
                                        <th>Kuartal</th>
                                        <th>Tahun</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($periodes as $periode)
                                        {{-- @if ($periode->status && $periode->status->id_status == 3 && 4 && 6) --}}
                                            <tr>
                                                {{-- <td>{{ $periode->no_dokumen_masuk }}</td> --}}
                                                <td>{{ $periode->kuartal }}</td>
                                                <td>{{ $periode->tahun }}</td>
                                                <td>{{ $periode->status ? $periode->status->nama : 'Belum Ada Status' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.show', $periode->id_periode_laporan) }}" class="btn btn-info">Detail</a>
                                                </td>
                                            </tr>
                                        {{-- @endif --}}
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end mt-3">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
