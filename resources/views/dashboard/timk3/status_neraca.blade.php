<!-- resources/views/dashboard/timk3/status_neraca.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">

        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h3 class="fw-bold my-3">Status Neraca</h3>
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
                                    <tr>
                                        <td>{{ $periode->kuartal }}</td>
                                        <td>{{ $periode->tahun }}</td>
                                        <td>{{ $periode->statusNeraca->nama }}</td>
                                        <td>
                                            <a href="{{ route('timk3.detailBulan', $periode->id_periode_laporan) }}" class="btn btn-info">Detail</a>
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
@endsection
