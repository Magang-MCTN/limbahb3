<!-- resources/views/dashboard/timk3/formperiode.blade.php -->

@extends('dashboard/app')

@section('content')
<div class="main-panel">
    <div class="container py-3 px-4">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="row px-5">
                        <div class="col d-flex justify-content-center">
                            <div class="d-flex rounded-circle justify-content-center mx-3" style="border-radius: 50%; width: 30px; height: 30px; background-color: #097B96">
                                <i class="mdi mdi-clipboard-outline d-flex" style="color:white; align-items: center;"></i>
                            </div>
                            <h2 class="fw-bold d-flex" style="color: #097B96;">Formulir Pelaporan Limbah B3 Keluar</h2>
                        </div>
                    </div>
                    <hr>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('timk3.submitFormKuartalTahun') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col form-group">
                                <label for="kuartal">Kuartal</label>
                                <select name="kuartal" class="form-select form-control" required>
                                    <option value="" disabled selected>Pilih</option>
                                    <option value="1">Kuartal I</option>
                                    <option value="2">Kuartal II</option>
                                    <option value="3">Kuartal III</option>
                                    <option value="4">Kuartal IV</option>
                                </select>
                            </div>

                            <div class="col form-group">
                                <label for="tahun">Tahun</label>
                                <input type="number" name="tahun" class="form-control" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn" style="background-color:#097B96; color: white" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
