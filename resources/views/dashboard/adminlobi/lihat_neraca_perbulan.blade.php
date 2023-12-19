<!-- resources/views/dashboard/timlb3/lihat_neraca_perbulan.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container py-3 px-4">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h2 class="fw-bold">Data Neraca Bulan {{ $bulan->nama_bulan }}</h2>
                        <hr>

                        <!-- Tampilkan data neraca 1 -->
                        {{-- <h4 class="fw-bold">Neraca 1</h4> --}}

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Jenis Limbah B3</th>
                                        <th>Sumber Limbah B3</th>
                                        <th>Dihasilkan</th>
                                        <th>Disimpan</th>
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
                                            <td>{{ $data->jenislimbah->jenis_limbah }}</td>
                                            <td>{{ $data->sumber_limbah }}</td>
                                            <td>{{ $data->dihasilkan }}</td>
                                            <td>{{ $data->disimpan }}</td>
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

                        <!-- Tampilkan data neraca 2 -->
                        {{-- <h4 class="fw-bold mt-4">Neraca 2</h4> --}}
                       @if ($neraca2)
                        <div class="table-responsive">
                            <!-- Tampilkan kolom-kolom neraca 2 sesuai kebutuhan -->
                            <table class="table table-boerdered">
                                <tr>
                                    <th>Total Neraca</th>
                                    <td>{{ $neraca2->total_neraca }}</td>
                                </tr>
                                <tr>
                                    <th>Residu</th>
                                    <td>{{ $neraca2->residu }}</td>
                                </tr>
                                <tr>
                                    <th>Limbah B3 Belum Dikelola</th>
                                    <td>{{ $neraca2->limbah_belum_dikelola }}</td>
                                </tr>
                                <tr>
                                    <th>Limbah B3 Tersisa</th>
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
                                    <th>Perizinan Limbah B3 KLH</th>
                                    <td>{{ $neraca2->perizinan_limbah_klh }}</td>
                                </tr>
                                <tr>
                                    <th>No Izin KLH</th>
                                    <td>{{ $neraca2->no_izin_limbah_klh }}</td>
                                </tr>
                                <tr>
                                    <th>Catatan</th>
                                    <td>{{ $neraca2->catatan }}</td>
                                </tr>
                                <tr></tr>

                            </table>
                            <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                        </div>

                    </div>
                    <div class="container mt-4">
                        <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@else
    <p>Data Neraca belum diisi untuk bulan ini.</p>
@endif
@endsection
