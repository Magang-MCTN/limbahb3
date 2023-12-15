@extends('dashboard/app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="home-tab">
            <div class="card mx-5">
                <div class="card-body">
                    <div class="container">
                        <div class="mb-4">
                            <span>Silahkan Upload tanda tangan anda <br>
                                untuk memudahkan proses approval laporan</span>
                        </div>
                        <!-- Form untuk mengunggah tanda tangan -->
                        <!-- Form untuk mengunggah atau menampilkan tanda tangan -->
                        <form action="{{ route('tanda_tangan.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @if($tandaTangan)
                                <!-- Menampilkan tanda tangan yang sudah ada -->
                                <img src="{{ asset('storage/'.$tandaTangan->path) }}" alt="Tanda Tangan" width="200" height="auto">
                            @else
                                <!-- Pesan jika tanda tangan belum tersedia -->
                                <p>Tanda tangan tidak tersedia.</p>
                            @endif<br>
                            <div class="form-group">
                                <input type="file" name="tanda_tangan" accept="image/*" class="form-control my-2" required>
                                <button type="submit" class="btn btn-mctn my-2" style="color: white">Unggah Tanda Tangan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
