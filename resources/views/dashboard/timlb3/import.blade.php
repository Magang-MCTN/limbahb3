@extends('dashboard.app')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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
                                <h2 class="fw-bold d-flex" style="color: #097B96;">Formulir Import Excel Limbah B3 Masuk</h2>
                              <br>  <h3 class="fw-bold d-flex" style="color: #960952;">Saat Ini Proses ini sedang Masa Development </h3>
                            </div>
                        </div>
                        <hr>

                        <!-- Formulir Excel Limbah Masuk -->
                        <form action="{{ route('timlb3.import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id_periode_laporan" value="{{ $id_periode }}">
                            <div class="row mb-3">
                                <div class="col-md-8 col-sm-6">
                                    <div class="form-group">
                                        <label for="file" class="form-label">Pilih File Excel</label>
                                        <input type="file" name="file" accept=".xlsx, .xls" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Import Data</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
