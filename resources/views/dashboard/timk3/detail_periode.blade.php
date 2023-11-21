<!-- resources/views/dashboard/timlb3/detail_periode.blade.php -->

@extends('dashboard.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <div class="container">
        <h2>Detail Periode Laporan</h2>

        <table class="table">
            <tr>
                <th>No Dokumen Masuk</th>
                <td>{{ $periode->no_dokumen_masuk }}</td>
            </tr>
            <tr>
                <th>Nama Laporan</th>
                <td>Limbah Keluar</td>
            </tr>
            <tr>
                <th>Kuartal</th>
                <td>Kuartal {{ $periode->kuartal }}</td>
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
                <td>{{ $periode->statuskeluar ? $periode->statuskeluar->nama : 'Tidak Ada Status' }}</td>
            </tr>
            <tr>
                <th>Alasan</th>
                <td>{{ $periode->alasan ?: 'Belum Ada' }}</td>
            </tr>
        </table>
        <div class="d-flex  mt-3">
            <a href="/status" class="btn btn-secondary">Kembali</a>

            {{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#konfirmasiModal">Kirim</button> --}}
            @if ($periode->status->id_status == 5) <!-- Ganti 1 dengan ID status yang sesuai -->
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#konfirmasiModal">Kirim</button>
        @endif




        </div>
        <div class="d-flex justify-content-end mt-3">

            <a href="{{ route('limbah.keluar', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-info ml-2">Lihat Detail</a>
            <a href="#" class="btn btn-success ml-2">Unduh Dokumen</a>
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
