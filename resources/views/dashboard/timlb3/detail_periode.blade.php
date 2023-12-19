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
                    <div class="container table-responsive">
                        <table class="table">
                            <tr>
                                <th>No Dokumen Masuk</th>
                                <td>{{ $periode->no_dokumen_masuk }}</td>
                            </tr>
                            <tr>
                                <th>Nama Laporan</th>
                                <td>Limbah B3 Masuk</td>
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
                                @if ($periode->status->id_status == 6)
                                <td><p class="badge badge-success">{{ $periode->status ? $periode->status->nama : 'Tidak Ada Status' }}</p></td>
                                @elseif ($periode->status->id_status == 4)
                                <td><p class="badge badge-danger">{{ $periode->status ? $periode->status->nama : 'Tidak Ada Status' }}</p></td>
                                @else
                                <td><p class="badge badge-warning">{{ $periode->status ? $periode->status->nama : 'Tidak Ada Status' }}</p></td>
                                @endif
                            </tr>
                            {{-- <tr>
                                <th>Alasan</th>
                                <td>{{ $periode->alasan ?: 'Belum Ada' }}</td>
                            </tr> --}}
                            <tr></tr>
                        </table>
                        <div class="d-flex justify-content-between mt-3">
                            <div class="">
                                <a href="/status" class="btn btn-primary me-1">Kembali</a>
                                {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#konfirmasiModal">Kirim</button> --}}
                                @if ($periode->status->id_status == 1) <!-- Ganti 1 dengan ID status yang sesuai -->
                                <button type="button" class="btn btn-success ms-1" data-toggle="modal" data-target="#konfirmasiModal">Kirim</button>
                                @elseif ($periode->status->id_status == 4)
                                <button type="button" class="btn btn-success ms-1" data-toggle="modal" data-target="#konfirmasiModal">Kirim Ulang</button>
                                @endif
                            </div>
                            <div>
                                <a href="{{ route('limbah.masuk', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-success me-1">Lihat Detail</a>
                                <a href="{{ route('limbah.export', $periode->id_periode_laporan) }}" class="btn btn-success ms-1">Unduh Dokumen</a>
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <a href="{{ route('timlb3.kirimPeriode', $periode->id_periode_laporan) }}" class="btn btn-success">Kirim</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
