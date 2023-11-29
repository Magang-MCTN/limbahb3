<!-- resources/views/dashboard/timlb3/limbah_masuk/index.blade.php -->

@extends('dashboard.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <div class="container">
        <h2>Data Limbah Masuk - {{ $periode->no_dokumen_masuk }}</h2>

        <table class="table">
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
                            <a href="{{ route('timlb3.editLimbahMasuk', $limbah->id_limbah_masuk) }}" class="btn btn-sm btn-primary">Edit</a>
                             <!-- Button trigger modal -->
                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal{{ $limbah->id_limbah_masuk }}">
                        Hapus
                    </button>
                    </tr>
                    <!-- Modal -->
    <div class="modal fade" id="hapusModal{{ $limbah->id_limbah_masuk }}" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
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
                    <form action="{{ route('timlb3.destroyLimbahMasuk', $limbah->id_limbah_masuk) }}" method="post">
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



@endsection
