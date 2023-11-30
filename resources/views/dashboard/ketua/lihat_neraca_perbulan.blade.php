<!-- resources/views/dashboard/timlb3/lihat_neraca_perbulan.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="container py-3 px-4">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h3 class="fw-bold">Data Neraca untuk Bulan {{ $bulan->nama_bulan }}</h3>

                    <!-- Tampilkan data neraca 1 -->
                    <h3 class="fw-bold">Neraca 1</h3>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Jenis Limbah</th>
                                        <th>Sumber Limbah</th>
                                        <th>Dihasilkan</th>
                                        <th>Dimanfaatkan</th>
                                        <th>Diolah</th>
                                        <th>Ditimbun</th>
                                        <th>Diserahkan</th>
                                        <th>eksport</th>
                                        <th>Lainnya</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($neraca1 as $data)
                                    <tr>
                                        <td>{{ $data->id_jenis_limbah }}</td>
                                        <td>{{ $data->sumber_limbah }}</td>
                                        <td>{{ $data->dihasilkan }}</td>
                                        <td>{{ $data->dimanfaatkan }}</td>
                                        <td>{{ $data->diolah }}</td>
                                        <td>{{ $data->ditimbun }}</td>
                                        <td>{{ $data->diserahkan }}</td>
                                        <td>{{ $data->eksport }}</td>
                                        <td>{{ $data->lainnya }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tampilkan data neraca 2 -->
                    <h3 class="fw-bold">Neraca 2</h3>

                    @if ($neraca2)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>Total Neraca</th>
                                                <td>{{ $neraca2->total_neraca }}</td>
                                            </tr>
                                            <tr>
                                                <th>Residu</th>
                                                <td>{{ $neraca2->residu }}</td>
                                            </tr>
                                            <tr>
                                                <th>Limbah Belum Dikelola</th>
                                                <td>{{ $neraca2->limbah_belum_dikelola }}</td>
                                            </tr>
                                            <tr>
                                                <th>Limbah Tersisa</th>
                                                <td>{{ $neraca2->limbah_tersisa }}</td>
                                            </tr>
                                            <tr>
                                                <th>Kinerja Pengelolaan</th>
                                                <td>{{ $neraca2->kinerja_pengelolaan }}</td>
                                            </tr>
                                            <tr>
                                                <th>Dokumen Kontrol</th>
                                                <td>{{ $neraca2->dokumen_kontrol }}</td>
                                            </tr>
                                            <tr>
                                                <th>Perizinan Limbah KLH</th>
                                                <td>{{ $neraca2->perizinan_limbah_klh }}</td>
                                            </tr>
                                            <tr>
                                                <th>No Izin Limbah KLH</th>
                                                <td>{{ $neraca2->no_izin_limbah_klh }}</td>
                                            </tr>
                                            <tr>
                                                <th>Catatan</th>
                                                <td>{{ $neraca2->catatan }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <p>Data Neraca 2 belum diisi untuk bulan ini.</p>
                    @endif
                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
