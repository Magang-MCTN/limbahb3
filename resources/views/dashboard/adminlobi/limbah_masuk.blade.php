<!-- resources/views/dashboard/timlb3/limbah_masuk/index.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container py-3 px-4">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <h3 class="fw-bold my-3">Data Limbah B3 Masuk - {{ $periode->no_dokumen_masuk }}</h3>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Limbah B3</th>
                                        <th>Satuan Limbah B3</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Maksimal Penyimpanan (hari)</th>
                                        <th>Sumber Limbah B3</th>
                                        <th>Bentuk Limbah B3</th>
                                        <th>Jumlah Limbah B3</th>
                                        <th>Berat/Satuan</th>
                                        <th>Berat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($limbahMasuk as $index => $limbah)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                            <td>{{ $limbah->jenisLimbah->jenis_limbah ?? '-' }}</td>
                                            <td>{{ $limbah->satuan_limbah }}</td>
                                            <td>{{ $limbah->tanggal_masuk }}</td>
                                            <td>{{ $limbah->maksimal_penyimpanan }}</td>
                                            <td>{{ $limbah->sumber_limbahB3 }}</td>
                                            <td>{{ $limbah->bentuk_limbahB3 }}</td>
                                            <td>{{ $limbah->jumlah_limbah }}</td>
                                            <td>{{ $limbah->berat_satuan }}</td>
                                            <td>{{ $limbah->berat }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

@endsection
