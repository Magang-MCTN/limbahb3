<!-- resources/views/dashboard/ophar/index.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="home-tab">

            <div class="container px-4">
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
                                <form method="get" action="">
                                    <div class="form-group">
                                        <label for="status_surat" class="form-label">Filter</label>
                                        <div class="input-group">
                                            <select id="status_surat" class="form-select form-control" name="status_surat">
                                                <option value="">Semua</option>
                                                {{-- <option value="2" @if($statusSurat == 2) selected @endif>Disetujui</option>
                                                <option value="5" @if($statusSurat == 5) selected @endif>Ditolak</option> --}}
                                            </select>
                                            <button class="btn mb-1 ms-1" type="submit" style="background-color: #097b96; color: white; border-radius:5px" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Filter</button>
                                        </div>
                                    </div>
                                </form>
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
                                            @if ($periode->status && ( $periode->status->id_status == 3 || $periode->status->id_status == 4))
                                                <tr>
                                                    <td>{{ $periode->kuartal }} ({{ $periode->keterangan_kuartal }})</td>
                                                    <td>{{ $periode->tahun }}</td>
                                                    <td><p class="badge badge-warning">{{ $periode->status ? $periode->status->nama : 'Belum Ada Status' }}</p></td>
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
            </div>
        </div>
    </div>
</div>
@endsection
