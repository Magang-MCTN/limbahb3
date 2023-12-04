<!-- resources/views/dashboard/ophar/index.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="container py-3 px-4">
        <div class="row mb-4">
            <h3 class="col fw-bold mt-4 ms-4">Status Laporan</h3>
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
                                    <tr>
                                        @if( $periode->status->id_status == 2 || $periode->status->id_status == 3  )
                                        {{-- <td>{{ $periode->no_dokumen_masuk }}</td> --}}
                                        <td>{{ $periode->kuartal }}</td>
                                        <td>{{ $periode->tahun }}</td>
                                        <td><p class="badge badge-warning">{{ $periode->status ? $periode->status->nama : 'Belum Ada Status' }}</p></td>
                                        <td>
                                            <a href="{{ route('ophr.show', $periode->id_periode_laporan) }}" class="btn btn-info">Detail</a>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
