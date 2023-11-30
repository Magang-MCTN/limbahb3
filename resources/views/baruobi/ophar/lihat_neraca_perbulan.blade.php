<!-- resources/views/dashboard/timlb3/lihat_neraca_perbulan.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="container">
    <h2>Data Neraca untuk Bulan {{ $bulan->nama_bulan }}</h2>

    <!-- Tampilkan data neraca 1 -->
    <h3>Neraca 1</h3>

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
    <h3>Neraca 2</h3>

    @if ($neraca2)
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <strong>Total Neraca:</strong> {{ $neraca2->total_neraca }}<br>
                    <strong>Residu:</strong> {{ $neraca2->residu }}<br>
                    <strong>Limbah belum dikelola:</strong> {{ $neraca2->limbah_belum_dikelola }}<br>
                    <strong>Limbah Tersisa:</strong> {{ $neraca2->limbah_tersisa }}<br>
                    <strong>Kinerja pengelolaan:</strong> {{ $neraca2->kinerja_pengelolaan}}<br>
                    <strong>Dokumen Kontrol:</strong> {{ $neraca2->dokumen_kontrol }}<br>
                    <strong>Perizinan Limbah KLH:</strong> {{ $neraca2->periinan_limbah_klh }}<br>
                    <strong>No Izin KLH:</strong> {{ $neraca2->no_izin_limbah_klh }}<br>
                    <strong>Catatan:</strong> {{ $neraca2->catatan }}<br>
                </div>
            </div>
        </div>
    </div>
    @else
    <p>Data Neraca 2 belum diisi untuk bulan ini.</p>
    @endif
</div>
@endsection
