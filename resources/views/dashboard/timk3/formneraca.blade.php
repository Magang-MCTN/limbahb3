<!-- resources/views/dashboard/timk3/formneraca.blade.php -->

@extends('dashboard.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2>Formulir Input Neraca</h2>

                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('timk3.submitFormNeraca') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="nama_bulan">Pilih Bulan:</label>
                        <select name="nama_bulan" class="form-control" required>
                            <option value="Januari">Januari</option>
                            <option value="Februari">Februari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="kuartal">Kuartal:</label>
                        <select name="kuartal" class="form-control" required>
                            <option value="1">Kuartal I</option>
                            <option value="2">Kuartal II</option>
                            <option value="3">Kuartal III</option>
                            <option value="4">Kuartal IV</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tahun">Tahun:</label>
                        <input type="number" name="tahun" class="form-control" required>
                    </div>

                    <!-- Tambahkan input lainnya sesuai kebutuhan -->

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
