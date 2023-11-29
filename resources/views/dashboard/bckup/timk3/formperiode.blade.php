<!-- resources/views/dashboard/timk3/formperiode.blade.php -->

@extends('dashboard/app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h2>Formulir Pelaporan Limbah B3 Keluar</h2>

                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('timk3.submitFormKuartalTahun') }}" method="post">
                    @csrf

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

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
