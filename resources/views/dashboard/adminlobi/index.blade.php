<!-- resources/views/dashboard/ophar/index.blade.php -->

@extends('dashboard.app')

@section('content')
<link rel="stylesheet" href="{{ asset('dashboard\template\css\cards.css') }}">

<div class="main-panel">
    <div class="content-wrapper">
        <div class="home-tab">
            <div class="container py-3 px-4">
                <div class="row">
                    <div class="col">
                        <a href="/" class="text-decoration-none">
                            <div class="card mb-2">
                                <div class="card-body d-flex align-self-center">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="fw-bold text-black">
                                                Total <br> Laporan
                                            </div>
                                            <div class="card-title" style="font-size: 24px">{{$jumlahLaporan}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="mdi mdi-archive" style="color: #097b96"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
    
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col">
                        <a href="/" class="text-decoration-none">
                            <div class="card mb-2">
                                <div class="card-body d-flex align-self-center">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="fw-bold text-black">
                                                Menunggu <br> Pengiriman
                                            </div>
                                            <div class="card-title" style="font-size: 24px">{{ $jumlahMenungguPengiriman }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="mdi mdi-file-document" style="color: #097b96"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
    
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col">
                        <a href="/" class="text-decoration-none">
                            <div class="card mb-2">
                                <div class="card-body d-flex align-self-center">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="fw-bold text-black">
                                                Laporan  <br>
                                                 Disetujui
                                            </div>
                                            <div class="card-title" style="font-size: 24px">{{ $jumlahSelesai }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="mdi mdi-file-check" style="color: #097b96"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
    
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col">
                        <a href="/" class="text-decoration-none">
                            <div class="card mb-2">
                                <div class="card-body d-flex align-self-center">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col">
                                            <div class="fw-bold text-black">
                                                Laporan <br>
                                                Ditolak
                                            </div>
                                            <div class="card-title" style="font-size: 24px">{{ $jumlahDitolak }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="mdi mdi-file-excel" style="color: #097b96"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="card my-4">
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
                                            @if ($periode->status && $periode->status->id_status == 3)
                                                <tr>
                                                    {{-- <td>{{ $periode->no_dokumen_masuk }}</td> --}}
                                                    <td>{{ $periode->kuartal }} ({{ $periode->keterangan_kuartal }})</td>
                                                    <td>{{ $periode->tahun }}</td>
                                                    <td><p class="badge badge-warning">{{ $periode->status ? $periode->status->nama : 'Belum Ada Status' }}</p></td>
                                                    <td>
                                                        <a href="{{ route('admin.show', $periode->id_periode_laporan) }}" class="btn btn-mctn" style="color: white">Detail</a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
    
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="/adminloby/dokumen">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
