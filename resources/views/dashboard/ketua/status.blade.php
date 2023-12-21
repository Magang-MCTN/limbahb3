<!-- resources/views/dashboard/ophar/index.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="home-tab">

            <div class="container px-4">
                <div class="row mb-4">
                    <h2 class="col fw-bold ms-4 mt-4">Status Laporan</h2>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                 </div>
                            <div class="col form-group">
                                <form id="search-form" method="get" action="{{ route('ketua.status') }}">
                                <label for="tahun" class="form-label">Cari Tahun</label>
                                <div class="input-group">
                                    <input type="text" name="tahun" class="form-control" value="{{ $tahun}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-mctn badge ms-1" style="color: white">Cari</button>
                                    </div>
                                </form>

                            </div>
                            </div>
                            {{-- <div class="col form-group">
                                <form method="get" action="{{ route('ketua.status') }}">
                                    <div class="form-group">
                                        <label for="status_surat" class="form-label">Filter Status</label>
                                        <div class="input-group">
                                            <select id="status_surat" class="form-select form-control" name="status_surat">
                                                <option value="">Semua</option>
                                                @foreach($daftarStatus as $status)
                                                    @if($status->id_status !== 6)
                                                    <option value="{{ $status->id_status }}" @if($statusSurat == $status->id_status) selected @endif>{{ $status->nama }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <button class="btn mb-1 ms-1" type="submit" style="background-color: #097b96; color: white; border-radius:5px" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div> --}}
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
                                            @foreach($statuses as $periode)
                                            @php
                                            $hasStatus = $periode->status && in_array($periode->status->id_status, [3]);
                                            $hasStatusKeluar = $periode->statuskeluar && in_array($periode->statuskeluar->id_status, [3]);
                                            $hasStatusNeraca = $periode->statusNeraca && in_array($periode->statusNeraca->id_status, [3]);
                                            $hasStatusTolak = $periode->status && $periode->status->id_status == 4;
                                            $hasStatusKeluarTolak = $periode->statuskeluar && $periode->statuskeluar->id_status == 4;
                                            $hasStatusNeracaTolak = $periode->statusNeraca && $periode->statusNeraca->id_status == 4;
                                        @endphp

                                            @if($hasStatus || $hasStatusKeluar || $hasStatusNeraca)
                                                <tr>
                                                    <td>{{ $periode->kuartal }} ({{ $periode->keterangan_kuartal }})</td>
                                                    <td>{{ $periode->tahun }}</td>
                                                    <td>
                                                        @if($hasStatus)
                                                            @if($hasStatusTolak)
                                                                <p class="badge badge-danger">{{ $periode->status->nama }}</p>
                                                            @else
                                                                <p class="badge badge-warning">{{ $periode->status->nama }}</p>
                                                            @endif
                                                        @elseif($hasStatusKeluar)
                                                            @if($hasStatusKeluarTolak)
                                                                <p class="badge badge-danger">{{ $periode->statuskeluar->nama }}</p>
                                                            @else
                                                                <p class="badge badge-warning">{{ $periode->statuskeluar->nama }}</p>
                                                            @endif
                                                        @elseif($hasStatusNeraca)
                                                            @if($hasStatusNeracaTolak)
                                                                <p class="badge badge-danger">{{ $periode->statusNeraca->nama }}</p>
                                                            @else
                                                                <p class="badge badge-warning">{{ $periode->statusNeraca->nama }}</p>
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('ketua.show', $periode->id_periode_laporan) }}" class="btn btn-mctn" style="color: white">Detail</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

 <div class="container">
                    <div class="mt-3 d-flex justify-content-end">
                        <ul class="pagination">
                            {{-- Previous Page Link --}}
                            @if ($statuses->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">&laquo;</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $statuses->previousPageUrl() }}" rel="prev">&laquo;</a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @for ($page = max(1, $statuses->currentPage() - 2); $page <= min($statuses->lastPage(), $statuses->currentPage() + 2); $page++)
                                @if ($statuses->currentPage() == $page)
                                    <li class="page-item active" aria-current="page">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $statuses->url($page) }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endfor

                            {{-- Next Page Link --}}
                            @if ($statuses->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $statuses->nextPageUrl() }}" rel="next">&raquo;</a>
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
