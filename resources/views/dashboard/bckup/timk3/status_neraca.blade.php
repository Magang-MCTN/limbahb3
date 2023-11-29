<!-- resources/views/dashboard/timk3/status_neraca.blade.php -->

@extends('dashboard.app')

@section('content')
    <div class="container">
        <h2>Status Neraca</h2>

        <table class="table">
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
                            <a href="{{ route('timk3.detailBulan', $periode->id_periode_laporan) }}" class="btn btn-primary">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
