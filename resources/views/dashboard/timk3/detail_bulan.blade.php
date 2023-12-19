<!-- resources/views/dashboard/timlb3/detail_bulan.blade.php -->

@extends('dashboard.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container py-3 px-4">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h2 class="fw-bold">Detail Laporan Neraca</h2>

                        <div class="">
                            <table class="table">
                                <tr>
                                    <th>No Dokumen Neraca</th>
                                    <td>{{ $periode->no_dokumen_neraca }}</td>
                                </tr>
                                <tr>
                                    <th>Nama Laporan</th>
                                    <td>Neraca Limbah B3</td>
                                </tr>
                                <tr>
                                    <th>Kuartal</th>
                                    <td>{{ $periode->kuartal }}</td>
                                </tr>
                                <tr>
                                    <th>Keterangan Kuartal</th>
                                    <td>{{ $periode->keterangan_kuartal }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun</th>
                                    <td>{{ $periode->tahun }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if ($periode->statusNeraca)
                                            @if ($periode->statusNeraca->id_status == 6)
                                                <span class="badge badge-success">{{ $periode->statusNeraca->nama }}</span>
                                            @elseif ($periode->statusNeraca->id_status == 4)
                                                <span class="badge badge-danger">{{ $periode->statusNeraca->nama }}</span>
                                            @else
                                                <span class="badge badge-warning">{{ $periode->statusNeraca->nama }}</span>
                                            @endif
                                        {{-- {{ $periode->statuskeluar ? $periode->statuskeluar->nama : 'Tidak Ada Status' }} --}}
                                        @else
                                            <span class="badge bg-secondary">Tidak Ada Status</span>
                                        @endif
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <th>Alasan</th>
                                    <td>{{ $periode->alasan ?: 'Belum Ada' }}</td>
                                </tr> --}}
                                <tr></tr>
                            </table>
                        </div>

                        <div class="table-bordered text-center">
                            <table class="table mt-4">
                                <thead>
                                    <tr>
                                        <th>Bulan</th>
                                        <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bulans as $bulan)
                                        <tr>
                                            <td>{{ $bulan->nama_bulan }}</td>
                                            <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                                            <td>
                                                <!-- Tambahkan tombol untuk melihat detail neraca perbulan -->
                                                <a href="{{ route('timk3.lihatNeracaPerbulan', ['id_bulan' => $bulan->id_bulan]) }}" class="btn btn-info">Lihat Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#konfirmasiModal">Kirim</button> --}}
                        <div class="d-flex mt-4">
                            <a href="/timk3/statusneraca" class="btn btn-primary me-1">Kembali</a>
                            @if ($periode->statusNeraca->id_status == 1) <!-- Ganti 1 dengan ID status yang sesuai -->
                            <a type="button" class="btn btn-success ms-1" data-toggle="modal" data-target="#konfirmasiModal">Kirim</a>
                            @endif
                        </div>
     <!-- Modal -->
     <div class="modal fade" id="konfirmasiModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Kirim</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin mengirim data ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                    <a href="{{ route('timk3.kirimneraca', $periode->id_periode_laporan) }}" class="btn btn-success">Ya, Kirim</a>

                </div>
            </div>
        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
