<!-- resources/views/dashboard/ophar/index.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="home-tab">
            <div class="container px-4">
                <h3 class="col fw-bold my-4 ms-4 pb-4">Menunggu Review</h3>

                <div class="card mt-4">
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
    @php
        $hasStatus = $periode->status && $periode->status->id_status == 5;
        $hasStatusKeluar = $periode->statuskeluar && $periode->statuskeluar->id_status == 5;
        $hasStatusNeraca = $periode->statusNeraca && $periode->statusNeraca->id_status == 5;
    @endphp

    @if($hasStatus || $hasStatusKeluar || $hasStatusNeraca)
        <tr>
            <td>{{ $periode->kuartal }} ({{ $periode->keterangan_kuartal }})</td>
            <td>{{ $periode->tahun }}</td>
            <td>
                @if($hasStatus)
                    <p class="badge badge-warning">{{ $periode->status->nama }}</p>
                @elseif($hasStatusKeluar)
                    <p class="badge badge-warning">{{ $periode->statuskeluar->nama }}</p>
                @elseif($hasStatusNeraca)
                    <p class="badge badge-warning">{{ $periode->statusNeraca->nama }}</p>
                @endif
            </td>
            <td>
                <a href="{{ route('ophar.show', $periode->id_periode_laporan) }}" class="btn btn-mctn" style="color: white">Detail</a>
            </td>
        </tr>
    @endif
@endforeach
                                        {{-- @foreach($periodes as $periode)
                                            <tr>
                                                <td>{{ $periode->no_dokumen_masuk }}</td>
                                                <td>{{ $periode->kuartal }}</td>
                                                <td>{{ $periode->tahun }}</td>
                                                <td>
                                                    @if( $periode->status)
                                                        @if($periode->status && $periode->status->id_status == 5)
                                                            <p class="badge badge-warning">{{ $periode->status->nama }}</p>
                                                        @else
                                                            <p>Belum Ada Status</p>
                                                        @endif
                                                    @endif
                                                    {{ $periode->status ? $periode->status->nama : 'Belum Ada Status' }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('ophar.show', $periode->id_periode_laporan) }}" class="btn btn-info">Detail</a>
                                                </td>
                                            </tr>
                                        @endforeach --}}
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
@endsection
