<!-- resources/views/dashboard/timlb3/detail_periode.blade.php -->

@extends('dashboard.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container py-3 px-4">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h2 class="m-3 fw-bold">Detail Periode Laporan</h2>

                        <table class="table">
                            <tr>
                                <th>No Dokumen</th>
                                <td>{{ $periode->no_dokumen_keluar }}</td>
                            </tr>
                            <tr>
                                <th>Nama Laporan</th>
                                <td>Limbah B3 Keluar</td>
                            </tr>
                            <tr>
                                <th>Kuartal</th>
                                <td>{{ $periode->kuartal }} ( {{ $periode->keterangan_kuartal }} )</td>
                            </tr>
                            <tr>
                                <th>Tahun</th>
                                <td>{{ $periode->tahun }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($periode->statuskeluar)
                                        @if ($periode->statuskeluar->id_status == 6)
                                            <span class="badge badge-success">{{ $periode->statuskeluar ? $periode->statuskeluar->nama : 'Tidak Ada Status' }}</span>
                                        @elseif ($periode->statuskeluar->id_status == 4)
                                            <span class="badge badge-danger">{{ $periode->statuskeluar ? $periode->statuskeluar->nama : 'Tidak Ada Status' }}</span>
                                        @else
                                            <span class="badge badge-warning">{{ $periode->statuskeluar ? $periode->statuskeluar->nama : 'Tidak Ada Status' }}</span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            {{-- <tr>
                                <th>Alasan</th>
                                <td>{{ $periode->alasan ?: 'Belum Ada' }}</td>
                            </tr> --}}
                            <tr></tr>
                        </table>
                        <div class="d-flex justify-content-between mt-4">
                            <div>
                                <a href="/timk3/status" class="btn btn-primary me-1">Kembali</a>

                                {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#konfirmasiModal">Kirim</button> --}}
                                @if ($periode->statuskeluar && $periode->statuskeluar->id_status == 1)
                                <button type="button" class="btn btn-success ms-1" data-toggle="modal" data-target="#konfirmasiModal">Kirim</button>
                            @endif
                            </div>
                            <div>
                                <a href="{{ route('limbah.keluar', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-info me-2">Lihat Detail</a>
                                <a href="#" class="btn btn-success">Unduh Dokumen</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

                <a href="{{ route('timlb3.kirimPeriodekeluar', $periode->id_periode_laporan) }}" class="btn btn-success">Ya, Kirim</a>

            </div>
        </div>
    </div>
</div>
@endsection
