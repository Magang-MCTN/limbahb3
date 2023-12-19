<!-- resources/views/dashboard/ophar/index.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="home-tab">
            <div class="container py-3 px-4">
                <div class="row">
                    <h3 class="col fw-bold mt-4">Arsip Laporan Limbah B3</h3>
                    <div class="col">
                        <div class="row">
                            <div class="col"></div>
                            <div class="col form-group">
                                <label for="cari" class="form-label">Cari</label>
                                <div class="input-group">
                                    <input type="text" name="cari" class="form-control">
                                    <div class="input-group-append">
                                        <button class="btn btn-mctn badge ms-1" style="color: white;">Cari</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="container">
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
                                            @if ($periode->status && $periode->status->id_status == 6)
                                                <tr>
                                                    {{-- <td>{{ $periode->no_dokumen_masuk }}</td> --}}
                                                    <td>{{ $periode->kuartal }} ({{ $periode->keterangan_kuartal }})</td>
                                                    <td>{{ $periode->tahun }}</td>
                                                    <td><p class="badge badge-success">{{ $periode->status ? $periode->status->nama : 'Belum Ada Status' }}</p></td>
                                                    <td>
                                                        <a href="{{ route('admin.show', $periode->id_periode_laporan) }}" class="btn btn-mctn" style="color: white">Detail</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="mt-3 d-flex justify-content-end">
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($periodes->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $periodes->previousPageUrl() }}" rel="prev">&laquo;</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @for ($page = max(1, $periodes->currentPage() - 2); $page <= min($periodes->lastPage(), $periodes->currentPage() + 2); $page++)
                                @if ($periodes->currentPage() == $page)
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $periodes->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endfor

                            {{-- Next Page Link --}}
                            @if ($periodes->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $periodes->nextPageUrl() }}" rel="next">&raquo;</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">&raquo;</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
