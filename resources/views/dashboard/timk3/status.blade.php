<!-- resources/views/status/index.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="container py-3 px-4">
        <div class="row">
            <h2 class="col fw-bold ms-4 mt-4">Status Laporan</h2>
            <div class="col">
                <div class="row mb-4">
                    <div class="col form-group">
                        <label for="cari" class="form-label">Cari</label>
                        <div class="input-group">
                            <input type="text" name="cari" class="form-control">
                            <div class="input-group-append">
                                <button class="btn badge ms-1" style="background-color: #097b96; color: white;" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Cari</button>
                            </div>

                        </div>
                    </div>
                    <div class="col form-group">
                        <label for="filter" class="form-label">Filter</label>
                        {{-- <select name="filter" class="form-select form-control" required>
                            <option value="" selected disabled>Pilih</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->status->id_status }}">{{ $status->status->id_status }}</option>
                            @endforeach
                        </select> --}}
                    </div>
                </div>

            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kuartal</th>
                                    <th>Tahun</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // Filter hanya data yang memiliki id_status_keluar
                                    $filteredStatuses = $statuses->filter(function ($status) {
    return !is_null($status->id_status_keluar) && $status->id_status_keluar != 6;
});
                                @endphp
                                @foreach ($filteredStatuses as $index => $status)
                                @if ($status->statuskeluar->id_status_keluar != 6)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $status->kuartal }}-({{ $status->keterangan_kuartal }})</td>
                                        <td>{{ $status->tahun }}</td>
                                        <td>{{ $status->statuskeluar->nama ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('timk3.detailPeriodelkeluar', $status->id_periode_laporan) }}"
                                                class="btn btn-info">Detail</a>
                                            <!-- Tambahkan tombol hapus jika dibutuhkan -->
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
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
</div>
@endsection
