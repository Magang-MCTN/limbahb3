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
                        <select name="filter" class="form-select form-control" required>
                            <option value="" selected disabled>Pilih</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->status->id_status }}">{{ $status->status->id_status }}</option>
                            @endforeach
                        </select>
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
                                        <th>No</th>
                                        <th>Kuartal</th>
                                        <th>Tahun</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($statuses as $index => $status)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $status->kuartal }}</td>
                                            <td>{{ $status->tahun }}</td>
                                            @if ($status->status->nama == 'Disetujui')
                                            <td><p class="badge badge-success">{{ $status->status->nama }}</p></td>
                                            @elseif ($status->status->nama == 'Ditolak')
                                            <td><p class="badge badge-danger">{{ $status->status->nama }}</p></td>
                                            @else
                                            <td><p class="badge badge-warning">{{ $status->status->nama }}</p></td>
                                            @endif
                                            <td>
                                                <a href="{{ route('timlb3.detailPeriode', $status->id_periode_laporan) }}" class="btn" style="background-color: #097b96; color: white" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Detail</a>
                                                <!-- Tambahkan tombol hapus jika dibutuhkan -->
                                            </td>
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
</div>

@endsection
