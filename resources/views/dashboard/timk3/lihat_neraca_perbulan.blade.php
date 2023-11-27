<!-- resources/views/dashboard/timlb3/lihat_neraca_perbulan.blade.php -->

@extends('dashboard.app')

@section('content')
    <div class="container">
        <h2>Data Neraca untuk Bulan {{ $bulan->nama_bulan }}</h2>

        <!-- Tampilkan data neraca 1 -->
        <h3>Neraca 1</h3>

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
                    <th>Aksi</th>
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
                        <td>
                            <a href="{{ route('timk3.editNeraca1', $data->id_neraca_limbah_1) }}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Tampilkan data neraca 2 -->
        <h3>Neraca 2</h3>
       @if ($neraca2)
    <div>
        <!-- Tampilkan kolom-kolom neraca 2 sesuai kebutuhan -->
        <strong>Total Neraca:</strong> {{ $neraca2->total_neraca }}<br>
        <strong>Residu:</strong> {{ $neraca2->residu }}<br>
        <strong>limbah belum dikelola:</strong> {{ $neraca2->limbah_belum_dikelola }}<br>
        <strong>Limbah Tersisa:</strong> {{ $neraca2->limbah_tersisa }}<br>
        <strong>kinerja pengelolaan:</strong> {{ $neraca2->kinerja_pengelolaan}}<br>
        <strong>Dokumen Kontrol:</strong> {{ $neraca2->dokumen_kontrol }}<br>
        <strong>Perizinan Limbah KLH:</strong> {{ $neraca2->periinan_limbah_klh }}<br>
        <strong>No Izin KLH:</strong> {{ $neraca2->no_izin_limbah_klh }}<br>
        <strong>Catatan:</strong> {{ $neraca2->catatan }}<br>
        <a href="{{ route('editNeraca2', $neraca2->id_neraca_limbah_2) }}" class="btn btn-primary">Edit</a>
        <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
    </div>
@else
    <p>Data Neraca 2 belum diisi untuk bulan ini.</p>
@endif
@endsection
