<!-- resources/views/dashboard/timlb3/limbah_masuk/index.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="container py-3 py-4">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h2>Data Limbah Masuk - {{ $periode->no_dokumen_masuk }}</h2>

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Jenis Limbah</th>
                                    <th>Satuan Limbah</th>
                                    <th>Tanggal Masuk</th>
                                    <th>Maksimal Penyimpanan (hari)</th>
                                    <th>Sumber Limbah</th>
                                    <th>Bentuk Limbah</th>
                                    <th>Jumlah Limbah</th>
                                    <th>Berat/Satuan</th>
                                    <th>Berat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($limbahMasuk as $limbah)
                                    <tr>
                                        <td>{{ $limbah->id_limbah_masuk }}</td>
                                        <td>{{ $limbah->jenisLimbah->jenis_limbah ?? '-' }}</td>
                                        <td>{{ $limbah->satuan_limbah }}</td>
                                        <td>{{ $limbah->tanggal_masuk }}</td>
                                        <td>{{ $limbah->maksimal_penyimpanan }}</td>
                                        <td>{{ $limbah->sumber_limbahB3 }}</td>
                                        <td>{{ $limbah->bentuk_limbahB3 }}</td>
                                        <td>{{ $limbah->jumlah_limbah }}</td>
                                        <td>{{ $limbah->berat_satuan }}</td>
                                        <td>{{ $limbah->berat }}</td>
                                        <td>
                                            <!-- Tambahkan tombol aksi di sini jika diperlukan -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ url()->previous() }}" class="btn" style="background-color:#097B96; color: white" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
s
