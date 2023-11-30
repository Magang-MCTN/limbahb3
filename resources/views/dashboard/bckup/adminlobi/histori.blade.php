<!-- resources/views/dashboard/ophar/index.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="container py-3 px-4">
        <div class="row">
            <h2 class="col fw-bold ms-4 mt-4">History Laporan</h2>
            <div class="col">
                <div class="row mb-4">
                    <div class="col"></div>
                    <div class="col form-group">
                        <label for="cari" class="form-label">Cari</label>
                        <div class="input-group">
                            <input type="text" name="cari" class="form-control">
                            <div class="input-group-append">
                                <button class="btn badge ms-1" style="background-color: #097b96; color: white;" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Cari</button>
                            </div>

                        </div>
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
                            <td>{{ $periode->kuartal }}</td>
                            <td>{{ $periode->tahun }}</td>
                            <td>{{ $periode->status ? $periode->status->nama : 'Belum Ada Status' }}</td>
                            <td>
                                <a href="{{ route('admin.show', $periode->id_periode_laporan) }}" class="btn btn-info">Detail</a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-3">

        </div>
    </div>
</div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>

@endsection
