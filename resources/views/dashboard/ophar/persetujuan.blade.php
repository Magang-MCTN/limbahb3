<!-- resources/views/dashboard/ophar/index.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="home-tab">
            <div class="container px-4">
                <div class="row">
                    <h3 class="col fw-bold mt-4 ms-4">Persetujuan Laporan</h3>
                    <div class="col">
                        <div class="row">

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
                                        <tr>
                                            <td>{{ $periode->kuartal }} ({{ $periode->keterangan_kuartal }})</td>
                                            <td>{{ $periode->tahun }}</td>
                                            <td>
                                                @if($periode->status && $periode->status->id_status == 5)
                                                    <p class="badge badge-warning">{{ $periode->status->nama }}</p>
                                                @elseif($periode->statuskeluar && $periode->statuskeluar->id_status == 5)
                                                    <p class="badge badge-warning">{{ $periode->statuskeluar->nama }}</p>
                                                @elseif($periode->statusNeraca && $periode->statusNeraca->id_status == 5)
                                                    <p class="badge badge-warning">{{ $periode->statusNeraca->nama }}</p>
                                                @else

                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('ophar.show', $periode->id_periode_laporan) }}" class="btn btn-mctn" style="color: white">Detail</a>
                                            </td>
                                        </tr>
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
