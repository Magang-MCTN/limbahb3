<!-- resources/views/status/index.blade.php -->

@extends('dashboard.app')

@section('content')
    <h2>Halaman Status</h2>

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
                    <td>{{ $status->status->nama}}</td>
                    <td>
                        <a href="{{ route('timlb3.detailPeriode', $status->id_periode_laporan) }}" class="btn btn-primary">Detail</a>
                        <!-- Tambahkan tombol hapus jika dibutuhkan -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
