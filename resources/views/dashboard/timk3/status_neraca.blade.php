<!-- resources/views/dashboard/timk3/status_neraca.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="home-tab">
            <div class="container px-4">
                <div class="row">
                    <h2 class="col fw-bold ms-4 mt-4">Status Neraca</h2>
                    <div class="col">
                        <div class="row">
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
                                <form method="get" action="">
                                    <div class="form-group">
                                        <label for="status_surat" class="form-label">Filter</label>
                                        <div class="input-group">
                                            <select id="status_surat" class="form-select form-control" name="status_surat" style="border-radius: 5px">
                                                <option value="">Semua</option>
                                                {{-- <option value="2" @if($statusSurat == 2) selected @endif>Disetujui</option>
                                                <option value="5" @if($statusSurat == 5) selected @endif>Ditolak</option> --}}
                                            </select>
                                            <button class="btn mb-1 ms-1" type="submit" style="background-color: #097b96; color: white; border-radius: 5px" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Filter</button>
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
                                                <td>
                                                    @if($periode->statusNeraca->nama == 'Selesai')
                                                        <span class="badge badge-success">{{ $periode->statusNeraca->nama }}</span>
                                                    @elseif($periode->statusNeraca->nama == 'Ditolak')
                                                        <span class="badge badge-danger">{{ $periode->statusNeraca->nama }}</span>
                                                    @else
                                                        <span class="badge badge-warning">{{ $periode->statusNeraca->nama }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('timk3.detailBulan', $periode->id_periode_laporan) }}" class="btn btn-mctn" style="color: white">Detail</a>
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
                <div class="container mt-3 d-flex justify-content-end">
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
@endsection
