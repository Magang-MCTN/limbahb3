<!-- create.blade.php -->

@extends('dashboard.app')

@section('content')
    <div class="container">
        <h2 >Buat Jenis Limbah B3</h2>
        <!-- Form untuk membuat jenis limbah -->
        <form method="post" action="{{ route('jenislimbah.store') }}">
            @csrf
            <label for="jenis_limbah">Jenis Limbah:</label>
            <input type="text" name="jenis_limbah" required>
            <button type="submit">Simpan</button>
        </form>
    </div>

    <a href="{{ route('timlb3.showFormLimbahMasuk', ['id_periode_laporan' => $id_periode_laporan]) }}" class="btn btn-secondary">Kembali ke Form Limbah Masuk</a>
@endsection
