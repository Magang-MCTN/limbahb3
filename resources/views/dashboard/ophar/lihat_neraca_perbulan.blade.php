<!-- resources/views/dashboard/timlb3/lihat_neraca_perbulan.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <div class="container home-tab">
                    <h3 class="fw-bold">Data Neraca untuk Bulan {{ $bulan->nama_bulan }}</h3 >

                    <!-- Tampilkan data neraca 1 -->
                    {{-- <h4 class="fw-bold">Neraca 1</h4> --}}

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Jenis Limbah B3</th>
                                            <th>Sumber Limbah B3</th>
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
                    </div>

                    <!-- Tampilkan data neraca 2 -->
                    {{-- <h4 class="fw-bold">Neraca 2</h4> --}}

                    @if ($neraca2)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
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
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <p>Data Neraca 2 belum diisi untuk bulan ini.</p>
                    @endif
                </div>
                <div class="d-flex mt-4">
                    <a href="{{url()->previous()}}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
