<!-- resources/views/dashboard/timlb3/edit_limbah_masuk.blade.php -->

@extends('dashboard.app')

@section('content')
    <div class="container">
        <h2>Edit Data Limbah Masuk</h2>

        <form method="POST" action="{{ route('limbah_masuk.update', $limbahMasuk->id_limbah_masuk) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="id_jenis_limbah">Jenis Limbah:</label>
                <select name="id_jenis_limbah" class="form-control">
                    @foreach($jenisLimbahs as $jenisLimbah)
                        <option value="{{ $jenisLimbah->id_jenis_limbah }}" {{ $limbahMasuk->id_jenis_limbah == $jenisLimbah->id_jenis_limbah ? 'selected' : '' }}>
                            {{ $jenisLimbah->jenis_limbah }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="satuan_limbah">Satuan Limbah:</label>
                <input type="text" name="satuan_limbah" class="form-control" value="{{ $limbahMasuk->satuan_limbah }}">
            </div>

            <div class="form-group">
                <label for="tanggal_masuk">Tanggal Masuk:</label>
                <input type="date" name="tanggal_masuk" class="form-control" value="{{ $limbahMasuk->tanggal_masuk }}">
            </div>

            <div class="form-group">
                <label for="maksimal_penyimpanan">Maksimal Penyimpanan (hari):</label>
                <input type="number" name="maksimal_penyimpanan" class="form-control" value="{{ $limbahMasuk->maksimal_penyimpanan }}">
            </div>

            <div class="form-group">
                <label for="sumber_limbahB3">Sumber Limbah:</label>
                <input type="text" name="sumber_limbahB3" class="form-control" value="{{ $limbahMasuk->sumber_limbahB3 }}">
            </div>

            <div class="form-group">
                <label for="bentuk_limbahB3">Bentuk Limbah:</label>
                <select name="bentuk_limbahB3" class="form-control">
                    <option value="liquid" {{ $limbahMasuk->bentuk_limbahB3 == 'liquid' ? 'selected' : '' }}>Liquid</option>
                    <option value="solid" {{ $limbahMasuk->bentuk_limbahB3 == 'solid' ? 'selected' : '' }}>Solid</option>
                </select>
            </div>

            <div class="form-group">
                <label for="jumlah_limbah">Jumlah Limbah:</label>
                <input type="number" name="jumlah_limbah" class="form-control" value="{{ $limbahMasuk->jumlah_limbah }}">
            </div>

            <div class="form-group">
                <label for="berat_satuan">Berat/Satuan:</label>
                <input type="number" name="berat_satuan" class="form-control" value="{{ $limbahMasuk->berat_satuan }}">
            </div>

            <!-- Tambahkan form input untuk atribut lainnya sesuai kebutuhan -->

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
