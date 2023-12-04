@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container py-3 px-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="fw-bold ms-3 my-3">Detail Periode</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Kuartal</th>
                                <td>{{ $periode->kuartal }} {{ $periode->keterangan_kuartal }}</td>
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
                    @if ($periode->limbahMasuk && optional($periode->status)->id_status == 6)
                        <h3 class="fw-bold">Limbah Masuk</h3>

                        <a href="{{ route('admin.masuk', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-info">Detail Limbah Masuk</a>
                        <!-- Input alasan untuk Limbah Masuk -->
                        <a href="{{ route('limbah.export', $periode->id_periode_laporan) }}" class="btn btn-success ml-2">Export to Excel</a>
                        <div class="d-flex justify-content-end mt-3">
                            <div id="reasonInput_limbah_masuk" style="display: none;">
                                <label for="alasan_limbah_masuk">Alasan:</label>
                                <textarea id="alasan_limbah_masuk" class="form-control"></textarea>
                                <!-- Tombol "Submit" untuk approve atau reject -->
                                <button class="btn btn-info mt-2" onclick="submitApproval('limbah_masuk')">Submit</button>
                            </div>
                        </div>
                    @endif

                    <!-- Dokumen Limbah Keluar -->
                    @if ($periode->limbahKeluar && optional($periode->statuskeluar)->id_status == 6)
                        <h3 class="fw-bold">Limbah Keluar</h3>
                        {{-- Tampilkan informasi dan tombol approve/reject --}}
                        <a href="{{ route('admin.keluar', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-info">Detail Limbah Keluar</a>
                        <a href="{{ route('keluar.export', $periode->id_periode_laporan) }}" class="btn btn-success ml-2">Export to Excel</a>
                    @endif

                    <!-- Dokumen Neraca Limbah 1 -->
                    @if ($periode->statusNeraca && optional($periode->statusNeraca)->id_status == 6)
                        <h3 class="fw-bold">Neraca Limbah</h3>
                        {{-- Tampilkan informasi dan tombol approve/reject --}}
                        <a href="{{ route('admin.detailBulan', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-info">Detail Limbah Neraca</a>
                        <a href="{{ route('export.neraca.pdf', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-success ml-2">Ekspor Neraca PDF</a>
                    @endif

                    <div class="mx-3">
                        <h3 class="fw-bold my-4">Tambah Dokumen Tambahan</h3>

                        @if ($dokumenTambahan)
                            {{-- Jika dokumen tambahan sudah ada, tampilkan tombol download --}}
                            <div>
                                <strong class="my-2">Dokumen Tambahan</strong><br>
                                <a href="{{ asset('storage/'.$dokumenTambahan->file_klhk) }}" class="btn btn-info" download>Download KLHK</a>
                                <a href="{{ asset('storage/'.$dokumenTambahan->file_pemda_riau) }}" class="btn btn-info" download>Download Pemda Riau</a>
                                <a href="{{ asset('storage/'.$dokumenTambahan->file_pemda_bengkalis) }}" class="btn btn-info" download>Download Pemda Bengkalis</a>
                            </div>
                        @else
                            {{-- Jika dokumen tambahan belum ada, tampilkan formulir upload --}}
                            <form action="{{ route('admin.tambahDokumen', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="file_klhk">File KLHK</label>
                                        <input type="file" class="form-control" id="file_klhk" name="file_klhk" accept="application/pdf" required>
                                    </div>
                                    <div class="col form-group">
                                        <label for="file_pemda_riau">File Pemda Riau</label>
                                        <input type="file" class="form-control" id="file_pemda_riau" name="file_pemda_riau" accept="application/pdf" required>
                                    </div>
                                    <div class="col form-group">
                                        <label for="file_pemda_bengkalis">File Pemda Bengkalis</label>
                                        <input type="file" class="form-control" id="file_pemda_bengkalis" name="file_pemda_bengkalis" accept="application/pdf" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Simpan Dokumen Tambahan</button>
                            </form>
                        @endif
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
