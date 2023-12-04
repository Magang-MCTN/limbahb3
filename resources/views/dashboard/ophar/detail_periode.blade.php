<!-- resources/views/dashboard/ophr/detail_periode.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="container py-3 px-4">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h3 class="fw-bold ms-2 mb-4">Detail Periode</h3>

                    <div class="table-responsive">
                        <table class="table mb-4">
                            <tr>
                                <th>Kuartal</th>
                                <td>{{ $periode->kuartal }}</td>
                            </tr>
                            <tr>
                                <th>Tahun</th>
                                <td>{{ $periode->tahun }}</td>
                            </tr>
                            <tr>
                                <th>Status Limbah Masuk </th>
                                <td>{{ $periode->status ? $periode->status->nama : 'Data tidak tersedia' }}</td>
                            </tr>
                            <tr>
                                <th>Status Limbah Keluar </th>
                                <td>{{ $periode->statuskeluar ? $periode->statuskeluar->nama : 'Data tidak tersedia' }}</td>
                            </tr>
                            <tr>
                                <th>Status Limbah Neraca </th>
                                <td>{{ $periode->statusNeraca ? $periode->statusNeraca->nama : 'Data tidak tersedia' }}</td>
                            </tr>
                            <tr>
                                <th>Alasan</th>
                                <td>{{ $periode->alasan ?: 'Tidak Ada Alasan' }}</td>
                            </tr>
                            <tr></tr>
                        </table>
                    </div>

                   <!-- Dokumen Limbah Masuk -->
                   @if ($periode->limbahMasuk && optional($periode->status)->id_status == 5)
                   <h3 class="fw-bold my-4">Limbah Masuk</h3>

                   <!-- Tombol "Approve" dan "Reject" -->
                   <a href="{{ route('ophar.lbmasuk', ['id' => $periode->id_periode_laporan, 'doc' => 'limbah_masuk']) }}" class="btn btn-success" onclick="showReasonInput('limbah_masuk')">Approve</a>
                   <a href="{{ route('ophar.lbmskrj', ['id' => $periode->id_periode_laporan, 'doc' => 'limbah_masuk']) }}" class="btn btn-danger" onclick="showReasonInput('limbah_masuk')">Reject</a>
                   <a href="{{ route('limbah.masukophar', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-primary">Detail Limbah Masuk</a>
                   <!-- Input alasan untuk Limbah Masuk -->
                   <div id="reasonInput_limbah_masuk" style="display: none;">
                       <label for="alasan_limbah_masuk">Alasan:</label>
                       <textarea id="alasan_limbah_masuk" class="form-control"></textarea>
                       <!-- Tombol "Submit" untuk approve atau reject -->
                       <button class="btn btn-primary mt-2" onclick="submitApproval('limbah_masuk')">Submit</button>
                   </div>
                    @endif

                   <!-- Dokumen Limbah Keluar -->
@if ($periode->limbahKeluar && optional($periode->statuskeluar)->id_status == 5)
<h3 class="fw-bold my-4">Limbah Keluar</h3>
{{-- Tampilkan informasi dan tombol approve/reject --}}
<a href="{{ route('ophar.lbkrl', ['id' => $periode->id_periode_laporan, 'doc' => 'limbah_keluar']) }}" class="btn btn-success">Approve</a>
<a href="{{ route('ophar.lbmrjek', ['id' => $periode->id_periode_laporan, 'doc' => 'limbah_keluar']) }}" class="btn btn-danger">Reject</a>
<a href="{{ route('limbah.keluarophar', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-primary">Detail Limbah Keluar</a>

<!-- Tambahkan tombol unduh surat PDF di samping -->
@if (file_exists(public_path('surat/laporan_pengelolaan_' . $periode->id_periode_laporan . '.pdf')))
    <a href="{{ asset('surat/laporan_pengelolaan_' . $periode->id_periode_laporan . '.pdf') }}" class="btn btn-info" download>Unduh Surat PDF</a>
@endif
@if (file_exists(public_path('surat/laporan_pengelolaan2_' . $periode->id_periode_laporan . '.pdf')))
<a href="{{ asset('surat/laporan_pengelolaan2_' . $periode->id_periode_laporan . '.pdf') }}" class="btn btn-info" download>Unduh Surat PDF</a>
@endif
@endif

                    <!-- Dokumen Neraca Limbah 1 -->
                    @if ($periode->statusNeraca && optional($periode->statusNeraca)->id_status == 5)
                    <h3 class="fw-bold my-4">Neraca Limbah</h3>
                    {{-- Tampilkan informasi dan tombol approve/reject --}}
                    <a href="{{ route('ophar.lnrcs', ['id' => $periode->id_periode_laporan, 'doc' => 'neraca_limbah_1']) }}" class="btn btn-success">Approve</a>
                    <a href="{{ route('ophar.lnrcr', ['id' => $periode->id_periode_laporan, 'doc' => 'neraca_limbah_1']) }}" class="btn btn-danger">Reject</a>
                    <a href="{{ route('ophar.detailBulanophar', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-primary">Detail Limbah Keluar</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
    <script>
        function showReasonInput(docType) {
            // Tampilkan input alasan
            document.querySelector('#reasonInput_' + docType).style.display = 'block';

            // Simpan link href untuk digunakan pada saat submit
            var linkHref = document.querySelector('.btn-' + docType).getAttribute('href');
            document.getElementById('submit_link').value = linkHref;
        }

        function submitApproval(docType) {
            // Ambil alasan dari textarea
            var reason = document.getElementById('alasan_' + docType).value;

            // Ambil link href yang sudah disimpan sebelumnya
            var linkHref = document.getElementById('submit_link').value;

            // Ubah link href dengan menambahkan parameter alasan
            var newLink = linkHref + '&alasan=' + encodeURIComponent(reason);

            // Redirect ke link dengan alasan
            window.location.href = newLink;
        }
    </script>
@endsection
