<!-- resources/views/edit_neraca2.blade.php -->

@extends('dashboard.app')

@section('content')
    <div class="container">
        <h2>Edit Neraca 2</h2>

        <form action="{{ route('updateNeraca2', $neraca2->id_neraca_limbah_2) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="total_neraca">Total Neraca</label>
                <input type="text" class="form-control" id="total_neraca" name="total_neraca" value="{{ $neraca2->total_neraca }}">
            </div>

            <div class="form-group">
                <label for="residu">Residu</label>
                <input type="text" class="form-control" id="residu" name="residu" value="{{ $neraca2->residu }}">
            </div>

            <div class="form-group">
                <label for="limbah_belum_dikelola">Limbah Belum Dikelola</label>
                <input type="text" class="form-control" id="limbah_belum_dikelola" name="limbah_belum_dikelola" value="{{ $neraca2->limbah_belum_dikelola }}">
            </div>

            <div class="form-group">
                <label for="limbah_tersisa">Limbah Tersisa</label>
                <input type="text" class="form-control" id="limbah_tersisa" name="limbah_tersisa" value="{{ $neraca2->limbah_tersisa }}">
            </div>

            <div class="form-group">
                <label for="kinerja_pengelolaan">Kinerja Pengelolaan</label>
                <input type="text" class="form-control" id="kinerja_pengelolaan" name="kinerja_pengelolaan" value="{{ $neraca2->kinerja_pengelolaan }}">
            </div>

            <div class="form-group">
                <label for="dokumen_kontrol">Dokumen Kontrol</label>
                <input type="text" class="form-control" id="dokumen_kontrol" name="dokumen_kontrol" value="{{ $neraca2->dokumen_kontrol }}">
            </div>

            <div class="form-group">
                <label for="perizinan_limbah_klh">Perizinan Limbah KLH</label>
                <input type="text" class="form-control" id="perizinan_limbah_klh" name="perizinan_limbah_klh" value="{{ $neraca2->perizinan_limbah_klh }}">
            </div>

            <div class="form-group">
                <label for="no_izin_limbah_klh">No Izin Limbah KLH</label>
                <input type="text" class="form-control" id="no_izin_limbah_klh" name="no_izin_limbah_klh" value="{{ $neraca2->no_izin_limbah_klh }}">
            </div>

            <div class="form-group">
                <label for="catatan">Catatan</label>
                <textarea class="form-control" id="catatan" name="catatan">{{ $neraca2->catatan }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
