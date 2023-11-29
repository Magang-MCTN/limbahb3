<!-- resources/views/dashboard/timk3/status_neraca.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="container py-3 px-4">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h3 class="fw-bold my-3">Status Neraca</h3>
                    
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
