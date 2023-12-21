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
                                    <th>Status Neraca Limbah B3</th>
                                    <td>{{ $periode->statusNeraca ? $periode->statusNeraca->nama : 'Data tidak tersedia' }}</td>
                                </tr>
                                <tr></tr>
                            </table>
                        </div>

                        <div class="row my-2">
                            <div class="col">
                                <!-- Blok Limbah B3 Masuk -->

                                @if (
                                    $periode->statusNeraca &&
                                    (
                                        optional($periode->statusNeraca)->id_status == 2 ||
                                        optional($periode->statusNeraca)->id_status == 3
                                    ) &&
                                    $periode->status &&
                                    (
                                        optional($periode->status)->id_status == 2 ||
                                        optional($periode->status)->id_status == 3
                                    ) &&
                                    $periode->limbahKeluar &&
                                    (
                                        optional($periode->statuskeluar)->id_status == 2 ||
                                        optional($periode->statuskeluar)->id_status == 3
                                    )
                                )
                                    <h4 class="fw-bold my-2">Limbah B3 Masuk</h4>

                                    <!-- Tombol "Approve" dan "Reject" (hanya tampilkan jika status adalah 2) -->
        @if (optional($periode->status)->id_status == 2)
        <a href="{{ route('ketua.lbmasuk', ['id' => $periode->id_periode_laporan, 'doc' => 'limbah_keluar']) }}" class="btn btn-success">Approve</a>
        <a href="{{ route('ophar.lbmrjek', ['id' => $periode->id_periode_laporan, 'doc' => 'limbah_keluar']) }}" class="btn btn-danger">Reject</a>
    @endif
                                    <!-- Tombol Detail Limbah Masuk -->
                                    <a href="{{ route('ketua.masuk', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-primary">Detail Limbah Masuk</a>
                                @endif
                            </div>

                            <!-- Blok Limbah B3 Keluar -->
                            <div class="col">
                                @if (
                                    $periode->statusNeraca &&
                                    (
                                        optional($periode->statusNeraca)->id_status == 2 ||
                                        optional($periode->statusNeraca)->id_status == 3
                                    ) &&
                                    $periode->status &&
                                    (
                                        optional($periode->status)->id_status == 2 ||
                                        optional($periode->status)->id_status == 3
                                    ) &&
                                    $periode->limbahKeluar &&
                                    (
                                        optional($periode->statuskeluar)->id_status == 2 ||
                                        optional($periode->statuskeluar)->id_status == 3
                                    )
                                )
                                    <h4 class="fw-bold">Limbah B3 Keluar</h4>

                                    <!-- Tombol "Approve" dan "Reject" -->
                                    @if (optional($periode->statuskeluar)->id_status == 2)
                                    <a href="{{ route('ketua.lbkrl', ['id' => $periode->id_periode_laporan, 'doc' => 'limbah_keluar']) }}" class="btn btn-success">Approve</a>
                                    <a href="{{ route('ketua.lbmrjek', ['id' => $periode->id_periode_laporan, 'doc' => 'limbah_keluar']) }}" class="btn btn-danger">Reject</a>
                                    @endif
                                    <!-- Tombol Detail Limbah Keluar -->
                                    <a href="{{ route('ketua.keluar', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-primary">Detail Limbah Keluar</a>
                                @endif
                            </div>
                        </div>
                        <div class="row my-2">
                            <!-- Blok Neraca Limbah -->
                            <div class="col">
                                @if (
    $periode->statusNeraca &&
    (
        optional($periode->statusNeraca)->id_status == 2 ||
        optional($periode->statusNeraca)->id_status == 3
    ) &&
    $periode->status &&
    (
        optional($periode->status)->id_status == 2 ||
        optional($periode->status)->id_status == 3
    ) &&
    $periode->limbahKeluar &&
    (
        optional($periode->statuskeluar)->id_status == 2 ||
        optional($periode->statuskeluar)->id_status == 3
    )
)
                                    <h4 class="fw-bold">Neraca Limbah B3</h4>
                                    @if (optional($periode->statusNeraca)->id_status == 2)
                                    <!-- Tombol "Approve" dan "Reject" -->
                                    <a href="{{ route('ketua.lnrcs', ['id' => $periode->id_periode_laporan, 'doc' => 'neraca_limbah_1']) }}" class="btn btn-success">Approve</a>
                                    <a href="{{ route('ketua.lnrcr', ['id' => $periode->id_periode_laporan, 'doc' => 'neraca_limbah_1']) }}" class="btn btn-danger">Reject</a>
                                    @endif
                                    <!-- Tombol Detail Neraca Limbah -->
                                    <a href="{{ route('ketua.detailBulan', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-primary">Detail Neraca Limbah</a>
                                @endif
                            </div>
                            <div class="col">
                                @if (
                                    $periode->statusNeraca &&
                                    (
                                        optional($periode->statusNeraca)->id_status == 2 ||
                                        optional($periode->statusNeraca)->id_status == 3
                                    ) &&
                                    $periode->status &&
                                    (
                                        optional($periode->status)->id_status == 2 ||
                                        optional($periode->status)->id_status == 3
                                    ) &&
                                    $periode->limbahKeluar &&
                                    (
                                        optional($periode->statuskeluar)->id_status == 2 ||
                                        optional($periode->statuskeluar)->id_status == 3
                                    )
                                )
                                @if (
                                    file_exists(public_path('surat/laporan_pengelolaan_' . $periode->id_periode_laporan . '.pdf')) ||
                                    file_exists(public_path('surat/laporan_pengelolaan2_' . $periode->id_periode_laporan . '.pdf')) ||
                                    file_exists(public_path('surat/laporan_pengelolaan3_' . $periode->id_periode_laporan . '.pdf')) ||
                                    file_exists(public_path('surat/laporan_pengelolaan2_' . $periode->id_periode_laporan . '.pdf'))
                                )
                                    <h4 class="fw-bold my-2">Surat Laporan</h4>

                                    {{-- Tampilkan tombol unduh jika file surat laporan tersedia --}}
                                    @if (file_exists(public_path('surat/laporan_pengelolaan_' . $periode->id_periode_laporan . '.pdf')))
                                        <a href="{{ asset('surat/laporan_pengelolaan_' . $periode->id_periode_laporan . '.pdf') }}" class="btn btn-info me-1" download>Unduh Surat Kabupaten</a>
                                    @endif

                                    @if (file_exists(public_path('surat/laporan_pengelolaan2_' . $periode->id_periode_laporan . '.pdf')))
                                        <a href="{{ asset('surat/laporan_pengelolaan2_' . $periode->id_periode_laporan . '.pdf') }}" class="btn btn-info ms-1" download>Unduh Surat Kabupaten</a>
                                    @endif

                                    @if (file_exists(public_path('surat/laporan_pengelolaan3_' . $periode->id_periode_laporan . '.pdf')))
                                        <a href="{{ asset('surat/laporan_pengelolaan3_' . $periode->id_periode_laporan . '.pdf') }}" class="btn btn-info me-1" download>Unduh Surat Kota</a>
                                    @endif

                                    @if (file_exists(public_path('surat/laporan_pengelolaan2_' . $periode->id_periode_laporan . '.pdf')))
                                        <a href="{{ asset('surat/laporan_pengelolaan2_' . $periode->id_periode_laporan . '.pdf') }}" class="btn btn-info ms-1" download>Unduh Surat Kota</a>
                                    @endif
                                @endif
                                @endif
                            </div>
                        </div>
                        <div class="d-flex mt-3">
                            <a href="/ketua/persetujuan" class="btn btn-primary">Kembali</a>
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

@endsection
