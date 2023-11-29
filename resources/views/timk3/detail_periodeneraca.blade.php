<!-- resources/views/dashboard/timk3/detail_periode.blade.php -->

@extends('dashboard.app')

@section('content')
    <div class="container">
        <h2>Detail Periode Neraca</h2>

        <div>
            <h3>Informasi Periode</h3>
            <p>Kuartal: {{ $periode->kuartal }}</p>
            <p>Tahun: {{ $periode->tahun }}</p>
            {{-- <p>Bulan: {{ $periode->bulan->nama_bulan }}</p> --}}
            <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
        </div>

        {{-- <div>
            <h3>Neraca Limbah 1</h3>
            @if ($neraca1)
                <p>Jenis Limbah: {{ $neraca1->id_jenis_limbah }}</p>
                <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
            @else
                <p>Data Neraca 1 belum diisi untuk periode ini.</p>
            @endif
        </div>

        <div>
            <h3>Neraca Limbah 2</h3>
            @if ($neraca2)
                <p>Total Neraca: {{ $neraca2->total_neraca }}</p>
                <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
            @else
                <p>Data Neraca 2 belum diisi untuk periode ini.</p>
            @endif
        </div> --}}
    </div>
@endsection
