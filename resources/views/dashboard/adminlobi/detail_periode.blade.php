@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container py-3 px-4">
            <div class="card">
                <div class="card-body">
                    <h3 class="fw-bold ms-3 my-3">Detail Laporan Limbah B3</h3>
                    <div class="table-responsive mb-4">
                        <table class="table">
                            <tr>
                                <th>Kuartal</th>
                                <td>{{ $periode->kuartal }} ({{ $periode->keterangan_kuartal }})</td>
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
                                <th>Status Neraca Limbah B3 </th>
                                <td>{{ $periode->statusNeraca ? $periode->statusNeraca->nama : 'Data tidak tersedia' }}</td>
                            </tr>
                            <tr></tr>
                        </table>
                    </div>

                    <div class="row px-4 my-4">
                        <div class="col">
                            <!-- Dokumen Limbah Masuk -->
                            <h4 class="fw-bold text-left">Limbah B3 Masuk</h4>
                            @if ($periode->limbahMasuk && optional($periode->status)->id_status !== 1)
                                <a href="{{ route('admin.masuk', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-info">Detail Limbah B3 Masuk</a>
                                <a href="{{ route('limbah.export', $periode->id_periode_laporan) }}" class="btn btn-success ml-2">Export to Excel</a>
                            @endif
                        </div>
                        <div class="col">
                            <!-- Dokumen Limbah Keluar -->
                            <h4 class="fw-bold">Limbah B3 Keluar</h4>
                            @if ($periode->limbahKeluar && optional($periode->statuskeluar)->id_status !== 1)
                                {{-- Tampilkan informasi dan tombol approve/reject --}}
                                <a href="{{ route('admin.keluar', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-info">Detail Limbah B3 Keluar</a>
                                <a href="{{ route('keluar.export', $periode->id_periode_laporan) }}" class="btn btn-success ml-2">Export to Excel</a>
                            @endif
                        </div>
                    </div>
                    <div class="row px-4 my-4">
                        <div class="col">
                            <!-- Dokumen Neraca Limbah 1 -->
                            <h4 class="fw-bold">Neraca Limbah B3</h4>
                            @if ($periode->statusNeraca && optional($periode->statusNeraca)->id_status !== 1)
                                {{-- Tampilkan informasi dan tombol approve/reject --}}
                                <a href="{{ route('admin.detailBulan', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-info">Detail Limbah B3 Neraca</a>
                                <a href="{{ route('export.neraca.pdf', ['id_periode_laporan' => $periode->id_periode_laporan]) }}" class="btn btn-success ml-2">Ekspor Neraca</a>
                            @endif
                        </div>
                        <div class="col">
                            <h4 class="fw-bold">Surat Laporan</h4>
                            @if (file_exists(public_path('surat/laporan_pengelolaanTTD_' . $periode->id_periode_laporan . '.pdf')))
                                <a href="{{ asset('surat/laporan_pengelolaanTTD_' . $periode->id_periode_laporan . '.pdf') }}" class="btn btn-info" download>Unduh Surat Kabupaten</a>
                            @endif
                            @if (file_exists(public_path('surat/laporan_pengelolaanTTD2_' . $periode->id_periode_laporan . '.pdf')))
                                <a href="{{ asset('surat/laporan_pengelolaanTTD2_' . $periode->id_periode_laporan . '.pdf') }}" class="btn btn-success" download>Unduh Surat Kota</a>
                            @endif
                        </div>
                    </div>


                    <div class="row px-4 my-4">
                        <div class="col">
                            <h4 class="fw-bold">Tanda Terima Elektronik</h4>
                            @if ($dokumenTambahan)
                                {{-- Jika dokumen tambahan sudah ada, tampilkan tombol download --}}
                                <div>
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

                        </div>

                        @endif
                    </div>

                    <div class="row px-3 mt-3">
                        <div class="col">
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
