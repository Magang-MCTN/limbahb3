<!-- resources/views/status/index.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="home-tab">
            <div class="container">
                <div class="row">
                    <h2 class="col fw-bold ms-4 mt-4">Status Laporan</h2>
                    <div class="col">
                        <div class="row">
                            <div class="col form-group">
                                <form id="search-form" method="get" action="{{ route('status.index') }}">
                                <label for="tahun" class="form-label">Cari Tahun</label>
                                <div class="input-group">
                                    <input type="text" name="tahun" class="form-control" value="{{ $tahun}}">
                                    <div class="input-group-append">
                                        <button class="btn btn-mctn badge ms-1" style="color: white">Cari</button>
                                    </div>
                                </form>

                            </div>
                            </div>
                            <div class="col form-group">
                                <form method="get" action="{{ route('status.index') }}">
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
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="table-responsive text-center">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Kuartal</th>
                                                <th>Tahun</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($statuses as $index => $status)
                                            @if ($status->status->id_status != 6)
                                                <tr>
                                                    <td>{{ $status->kuartal }} ({{ $status->keterangan_kuartal }})</td>
                                                    <td>{{ $status->tahun }}</td>
                                                    @if ($status->status->id_status == 4)
                                                    <td><p class="badge badge-danger">{{ $status->status->nama }}</p></td>
                                                    @else
                                                    <td><p class="badge badge-warning">{{ $status->status->nama }}</p></td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ route('timlb3.detailPeriode', $status->id_periode_laporan) }}" class="btn" style="background-color: #097b96; color: white" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Detail</a>
                                                        <!-- Tambahkan tombol hapus jika dibutuhkan -->
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
