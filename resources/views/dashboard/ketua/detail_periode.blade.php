<!-- resources/views/dashboard/ophr/detail_periode.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container py-4">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h3 class="fw-bold ms-3 mb-4">Detail Laporan</h3>

                        <div class="table-responsive my-4">
                            <table class="table">
                                <tr>
                                    <th>Kuartal</th>
                                    <td>{{ $periode->kuartal }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun</th>
                                    <td>{{ $periode->tahun }}</td>
                                </tr>
                                <tr>
                                    <th>Status Limbah B3 Masuk </th>
                                    <td>{{ $periode->status ? $periode->status->nama : 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>Status Limbah B3 Keluar </th>
                                    <td>{{ $periode->statuskeluar ? $periode->statuskeluar->nama : 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>Status Limbah B3 Neraca </th>
                                    <td>{{ $periode->statusNeraca ? $periode->statusNeraca->nama : 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr>
                                    <th>Alasan</th>
                                    <td>{{ $periode->alasan ?: 'Tidak Ada Alasan' }}</td>
                                </tr>
                                <tr></tr>
                            </table>
                        </div>

                        <div class="row my-2">
                            <div class="col">
                                <!-- Dokumen Limbah Masuk -->
                                <div>
                                    <h4 class="fw-bold my-2">Limbah B3 Masuk</h4>

                                    @if ($periode->limbahMasuk && optional($periode->status)->id_status == 2)
                                    <!-- Tombol "Approve" dan "Reject" -->
                                    <a href="{{ route('ketua.lbmasuk', ['id' => $periode->id_periode_laporan, 'doc' => 'limbah_keluar']) }}" class="btn btn-success">Approve</a>
                                    <a href="{{ route('ophar.lbmrjek', ['id' => $periode->id_periode_laporan, 'doc' => 'limbah_keluar']) }}" class="btn btn-danger">Reject</a>
                                    @endif

                                    <a href="{{ route('ketua.masuk', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-primary">Detail Limbah Masuk</a>

                                    <!-- Input alasan untuk Limbah Masuk -->
                                    {{-- <form id="approvalForm" style="display: none;" action="{{ route('ketua.lbmasuk', ['id' => $periode->id_periode_laporan]) }}" method="GET">
                                        @csrf
                                        <div class="ms-3">
                                            <input type="hidden" id="submit_action" name="action" value="">
                                            <input type="hidden" id="submit_link" name="link" value="">

                                            <label for="alasan_limbah_masuk">Alasan:</label>
                                            <textarea id="alasan_limbah_masuk" class="form-control"></textarea>

                                            <!-- Tombol "Submit" untuk approve atau reject -->
                                            <button class="btn btn-primary mt-2" type="button" onclick="submitApproval('limbah_masuk')">Submit</button>
                                        </div>
                                    </form> --}}
                                </div>
                            </div>
                            <div class="col">
                                <!-- Dokumen Limbah Keluar -->
                                <h4 class="fw-bold">Limbah B3 Keluar</h4>
                                {{-- Tampilkan informasi dan tombol approve/reject --}}
                                @if ($periode->limbahKeluar && optional($periode->statuskeluar)->id_status == 2)
                                <a href="{{ route('ketua.lbkrl', ['id' => $periode->id_periode_laporan, 'doc' => 'limbah_keluar']) }}" class="btn btn-success">Approve</a>
                                <a href="{{ route('ketua.lbmrjek', ['id' => $periode->id_periode_laporan, 'doc' => 'limbah_keluar']) }}" class="btn btn-danger">Reject</a>
                                @endif
                                <a href="{{ route('ketua.keluar', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-primary">Detail Limbah Keluar</a>
                            </div>
                        </div>

                        {{-- <div>
                            <h4 class="fw-bold ms-3 mb-4">Limbah B3 Masuk</h4>

                            <!-- Tombol "Approve" dan "Reject" -->
                            <div class="ms-3">
                                <a href="{{ route('ketua.lbmasuk', ['id' => $periode->id_periode_laporan, 'doc' => 'limbah_masuk']) }}" class="btn btn-success" onclick="showReasonInput('limbah_masuk')">Approve</a>
                                <a href="{{ route('ketua.lbmskrj', ['id' => $periode->id_periode_laporan, 'doc' => 'limbah_masuk']) }}" class="btn btn-danger" onclick="showReasonInput('limbah_masuk')">Reject</a>
                                <a href="{{ route('ketua.masuk', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-primary">Detail Limbah Masuk</a>
                                <!-- Input alasan untuk Limbah Masuk -->
                                <div id="reasonInput_limbah_masuk" style="display: none;">
                                    <label for="alasan_limbah_masuk">Alasan:</label>
                                    <textarea id="alasan_limbah_masuk" class="form-control"></textarea>
                                    <!-- Tombol "Submit" untuk approve atau reject -->
                                    <button class="btn btn-primary mt-2" onclick="submitApproval('limbah_masuk')">Submit</button>
                                </div>
                            </div>
                        </div> --}}

                        <div class="row my-4">
                            <div class="col">
                                <!-- Dokumen Neraca Limbah 1 -->
                                <h4 class="fw-bold">Neraca Limbah B3</h4>
                                {{-- Tampilkan informasi dan tombol approve/reject --}}
                                @if ($periode->statusNeraca && optional($periode->statusNeraca)->id_status == 2)
                                <a href="{{ route('ketua.lnrcs', ['id' => $periode->id_periode_laporan, 'doc' => 'neraca_limbah_1']) }}" class="btn btn-success">Approve</a>
                                <a href="{{ route('ketua.lnrcr', ['id' => $periode->id_periode_laporan, 'doc' => 'neraca_limbah_1']) }}" class="btn btn-danger">Reject</a>
                                @endif
                                <a href="{{ route('ketua.detailBulan', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-primary">Detail Neraca Limbah</a>

                            </div>
                            <div class="col">
                                <h4 class="fw-bold my-2">Surat Laporan</h4>
                                {{-- <a href="{{ route('generate-pdf', ['id' => $periode->id_periode_laporan]) }}" class="btn btn-primary">Generate PDF</a> --}}
                                @if (file_exists(public_path('surat/laporan_pengelolaan_' . $periode->id_periode_laporan . '.pdf')))
                                    <a href="{{ asset('surat/laporan_pengelolaan_' . $periode->id_periode_laporan . '.pdf') }}" class="btn btn-info me-1" download>Unduh Surat Kota</a>
                                @endif
                                @if (file_exists(public_path('surat/laporan_pengelolaan2_' . $periode->id_periode_laporan . '.pdf')))
                                <a href="{{ asset('surat/laporan_pengelolaan2_' . $periode->id_periode_laporan . '.pdf') }}" class="btn btn-info ms-1" download>Unduh Surat Kota</a>
                                @endif


                                @if (file_exists(public_path('surat/laporan_pengelolaan3_' . $periode->id_periode_laporan . '.pdf')))
                                    <a href="{{ asset('surat/laporan_pengelolaan3_' . $periode->id_periode_laporan . '.pdf') }}" class="btn btn-info me-1" download>Unduh Surat Kabupaten</a>
                                @endif
                                @if (file_exists(public_path('surat/laporan_pengelolaan2_' . $periode->id_periode_laporan . '.pdf')))
                                <a href="{{ asset('surat/laporan_pengelolaan2_' . $periode->id_periode_laporan . '.pdf') }}" class="btn btn-info ms-1" download>Unduh Surat Kabupaten</a>
                                @endif
                            </div>
                        </div>



                        <div class="d-flex mt-3">
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showReasonInput(docType, action) {
        // Tampilkan input alasan
        document.querySelector('#approvalForm').style.display = 'block';

        // Simpan tindakan (approve/reject) untuk digunakan pada saat submit
        document.getElementById('submit_action').value = action;

        // Simpan link href untuk digunakan pada saat submit
        var linkHref = document.querySelector('.btn-' + docType).getAttribute('href');
        document.getElementById('submit_link').value = linkHref;
    }

    function submitApproval(docType) {
        // Ambil alasan dari textarea
        var reason = document.getElementById('alasan_' + docType).value;

        // Setel nilai alasan pada input form
        document.getElementById('approvalForm').action = document.getElementById('submit_link').value;
        document.getElementById('alasan_limbah_masuk').value = reason;

        // Submit formulir secara otomatis
        document.getElementById('approvalForm').submit();
    }
</script>
{{-- <script>
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
</script> --}}
@endsection
