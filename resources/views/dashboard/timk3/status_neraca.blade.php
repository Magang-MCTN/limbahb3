<!-- resources/views/dashboard/timk3/status_neraca.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="container py-3 px-4">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h3 class="fw-bold my-3">Status Neraca</h3>

                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>Kuartal</th>
                                    <th>Tahun</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($periodes as $periode)
                                @if ($periode->statusNeraca->id_status != 6)
                                    <tr>
                                        <td>{{ $periode->kuartal }} ({{ $periode->keterangan_kuartal }})</td>
                                        <td>{{ $periode->tahun }}</td>
                                        <td>{{ $periode->statusNeraca->nama }}</td>
                                        <td>
                                            <a href="{{ route('timk3.detailBulan', $periode->id_periode_laporan) }}" class="btn btn-info">Detail</a>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
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
</div>
@endsection
