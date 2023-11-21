<!-- resources/views/dashboard/timlb3/edit_limbah_keluar.blade.php -->

@extends('dashboard.app')

@section('content')
    <div class="container">
        <h2>Edit Data Limbah keluar</h2>

        <form method="POST" action="{{ route('limbah_keluar.update', $limbahkeluar->id_limbah_keluar) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="id_jenis_limbah">Jenis Limbah:</label>
                <select name="id_jenis_limbah" class="form-control">
                    @foreach($jenisLimbahs as $jenisLimbah)
                        <option value="{{ $jenisLimbah->id_jenis_limbah }}" {{ $limbahkeluar->id_jenis_limbah == $jenisLimbah->id_jenis_limbah ? 'selected' : '' }}>
                            {{ $jenisLimbah->jenis_limbah }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="tujuanPenyerahan">Tujuan Penyerahan</label>
                <input type="text" name="tujuanPenyerahan" class="form-control" value="{{ $limbahkeluar->tujuanPenyerahan }}">
            </div>

            <div class="form-group">
                <label for="tanggal_keluar">Tanggal keluar:</label>
                <input type="date" name="tanggal_keluar" class="form-control" value="{{ $limbahkeluar->tanggal_keluar }}">
            </div>

            <div class="form-group">
                <label for="jumlahkg">Jumlah KG (hari):</label>
                <input type="number" name="jumlahkg" class="form-control" value="{{ $limbahkeluar->jumlahkg }}">
            </div>

            <div class="form-group">
                <label for="sisa_lb3">Sisa Limbah B3 :</label>
                <input type="text" name="sisa_lb3" class="form-control" value="{{ $limbahkeluar->sisa_lb3 }}">
            </div>



            <div class="form-group">
                <label for="buktiNomorDokumen">Bukti Nomor Dokumen:</label>
                <input type="text" name="buktiNomorDokumen" class="form-control" value="{{ $limbahkeluar->buktiNomorDokumen }}">
            </div>



            <!-- Tambahkan form input untuk atribut lainnya sesuai kebutuhan -->

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
