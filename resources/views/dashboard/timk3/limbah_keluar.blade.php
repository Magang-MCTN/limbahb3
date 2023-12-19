<!-- resources/views/dashboard/timlb3/limbah_masuk/index.blade.php -->

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
                    <div class="container">
                        <h4>Data Limbah B3 Keluar - <span class="fw-bold">{{ $periode->no_dokumen_keluar}}</span></h4>

                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Jenis Limbah B3</th>
                                        <th>Tujuan Penyerahan</th>
                                        <th>Tanggal Keluar</th>
                                        <th>Jumlah Limbah B3 Keluar KG:</th>
                                        <th>Sisa LB3 di TPS (ton):</th>
                                        <th>Bukti Nomor Dokumen</th>
                                        <th>Jumlah Ton</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($limbahkeluar as $limbah)
                                        <tr>
                                            <td>{{ $limbah->id_limbah_keluar }}</td>
                                            <td>{{ $limbah->jenisLimbah->jenis_limbah ?? '-' }}</td>
                                            <td>{{ $limbah->tujuanPenyerahan }}</td>
                                            <td>{{ $limbah->tanggal_keluar}}</td>
                                            <td>{{ $limbah->jumlahkg }}</td>
                                            <td>{{ $limbah->sisa_lb3 }}</td>
                                            <td>{{ $limbah->buktiNomorDokumen }}</td>
                                            <td>{{ $limbah->jumlahton }}</td>
                                            <td>
                                                <a href="{{ route('timk3.editLimbahkeluar', $limbah->id_limbah_keluar) }}" class="btn btn-sm btn-primary">Edit</a>
                                                 <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal{{ $limbah->id_limbah_keluar }}">
                                                Hapus
                                            </button>
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal fade" id="hapusModal{{ $limbah->id_limbah_keluar}}" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menghapus data ini?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <form action="{{ route('timlb3.destroyLimbahkeluar', $limbah->id_limbah_keluar) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            <a class="btn btn-mctn" href="{{ url()->previous() }}">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
