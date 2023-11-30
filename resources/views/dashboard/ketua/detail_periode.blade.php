<!-- resources/views/dashboard/ophr/detail_periode.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="container px-3 py-4">
        <div class="card">
            <div class="card-body">
                <div class="home-tab">
                    <h3 class="fw-bold ms-3 mb-4">Detail Periode</h3>

                    <div class="table-responsive">
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
                    @if ($periode->limbahMasuk && optional($periode->status)->id_status == 2)
                    <div>
                        <h3 class="fw-bold ms-3 mb-4">Limbah Masuk</h3>

                        <!-- Tombol "Approve" dan "Reject" -->
                        <div class="ms-3">
                            <button class="btn btn-success" onclick="showReasonInput('limbah_masuk', 'approve')">Approve</button>
                            <button class="btn btn-danger" onclick="showReasonInput('limbah_masuk', 'reject')">Reject</button>
                            <a href="{{ route('ketua.masuk', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-primary">Detail Limbah Masuk</a>
                        </div>

                        <!-- Input alasan untuk Limbah Masuk -->
                        <form id="approvalForm" style="display: none;" action="{{ route('ketua.masuk', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" method="POST">
                            @csrf
                            <div class="ms-3">
                                <input type="hidden" id="submit_action" name="action" value="">
                                <input type="hidden" id="submit_link" name="link" value="">

                                <label for="alasan_limbah_masuk">Alasan:</label>
                                <textarea id="alasan_limbah_masuk" class="form-control"></textarea>

                                <!-- Tombol "Submit" untuk approve atau reject -->
                                <button class="btn btn-primary mt-2" type="button" onclick="submitApproval('limbah_masuk')">Submit</button>
                            </div>
                        </form>
                    </div>

                    {{-- <div>
                        <h3 class="fw-bold ms-3 mb-4">Limbah Masuk</h3>

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
                    @endif

                    <!-- Dokumen Limbah Keluar -->
                    @if ($periode->limbahKeluar && optional($periode->statuskeluar)->id_status == 2)
                    <h3 class="fw-bold">Limbah Keluar</h3>
                    {{-- Tampilkan informasi dan tombol approve/reject --}}
                    <div class="ms-3">
                        <a href="{{ route('ketua.lbkrl', ['id' => $periode->id_periode_laporan, 'doc' => 'limbah_keluar']) }}" class="btn btn-success">Approve</a>
                        <a href="{{ route('ketua.lbmrjek', ['id' => $periode->id_periode_laporan, 'doc' => 'limbah_keluar']) }}" class="btn btn-danger">Reject</a>
                        <a href="{{ route('ketua.keluar', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-primary">Detail Limbah Keluar</a>
                    </div>
                    @endif

                    <!-- Dokumen Neraca Limbah 1 -->
                    @if ($periode->statusNeraca && optional($periode->statusNeraca)->id_status == 2)
                    <h3 class="fw-bold">Neraca Limbah</h3>
                    {{-- Tampilkan informasi dan tombol approve/reject --}}
                    <div class="ms-3">
                        <a href="{{ route('ketua.lnrcs', ['id' => $periode->id_periode_laporan, 'doc' => 'neraca_limbah_1']) }}" class="btn btn-success">Approve</a>
                        <a href="{{ route('ketua.lnrcr', ['id' => $periode->id_periode_laporan, 'doc' => 'neraca_limbah_1']) }}" class="btn btn-danger">Reject</a>
                        <a href="{{ route('ketua.detailBulan', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-primary">Detail Limbah Keluar</a>
                    </div>
                    @endif
                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
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
