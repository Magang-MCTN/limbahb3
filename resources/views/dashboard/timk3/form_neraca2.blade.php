<!-- resources/views/dashboard/timk3/form_neraca2.blade.php -->

@extends('dashboard.app')

@section('content')
    <div class="container">
        <h2>Formulir Pengisian Neraca Limbah 2</h2>

        <form method="post" action="{{ route('timk3.submitFormNeraca2', $bulan->id_bulan) }}">
            @csrf
            <!-- Total Neraca -->
            <div class="form-group">
                <label for="total_neraca">Total Neraca:</label>
                <input type="number" name="total_neraca" class="form-control" required>
            </div>

            <!-- Residu -->
            <div class="form-group">
                <label for="residu">Residu:</label>
                <input type="number" name="residu" class="form-control" required>
            </div>

            <!-- Limbah Belum Dikelola -->
            <div class="form-group">
                <label for="limbah_belum_dikelola">Limbah Belum Dikelola:</label>
                <input type="number" name="limbah_belum_dikelola" class="form-control" required>
            </div>

            <!-- Limbah Tersisa -->
            <div class="form-group">
                <label for="limbah_tersisa">Limbah Tersisa:</label>
                <input type="number" name="limbah_tersisa" class="form-control" required>
            </div>

            <!-- Kinerja Pengelolaan -->
            <div class="form-group">
                <label for="kinerja_pengelolaan">Kinerja Pengelolaan:</label>
                <input type="number" name="kinerja_pengelolaan" class="form-control" required>
            </div>

            <!-- Dokumen Kontrol -->
            <div class="form-group">
                <label for="dokumen_kontrol">Dokumen Kontrol:</label>
                <input type="text" name="dokumen_kontrol" class="form-control" required>
            </div>

            <!-- Perizinan Limbah KLH -->
            <div class="form-group">
                <label for="perizinan_limbah_klh">Perizinan Limbah KLH:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="perizinan_limbah_klh" value="ada" required>
                    <label class="form-check-label">Ada</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="perizinan_limbah_klh" value="tidak" required>
                    <label class="form-check-label">Tidak</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="perizinan_limbah_klh" value="kedaluarsa" required>
                    <label class="form-check-label">Kedaluarsa</label>
                </div>
            </div>

            <!-- Textarea untuk No Izin Limbah KLH -->
            <div class="form-group">
                <label for="no_izin_limbah_klh">No Izin Limbah KLH:</label>
                <textarea name="no_izin_limbah_klh" class="form-control" rows="3"></textarea>
            </div>

            <!-- Catatan -->
            <div class="form-group">
                <label for="catatan">Catatan:</label>
                <textarea name="catatan" class="form-control"></textarea>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-primary" type="submit">Simpan Neraca 2</button>
            </div>
        </form>
    </div>
@endsection
