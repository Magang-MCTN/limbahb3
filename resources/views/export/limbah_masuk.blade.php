

<table>
    <thead>
        <tr>
            <th>No </th>
            <th>Jenis Limbah B3</th>
            <th>Satuan Limbah</th>
            <th>Tanggal Masuk Limbah B3</th>
            <th>Sumber Limbah B3</th>
            <th>Bentuk Limbah B3</th>
            <th>Maksimal Penyimpanan (180-360 hr)</th>
            <th>Jumlah</th>
            <th>Berat/Satuan</th>
            <th>Berat (kg)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($limbahMasuk as $index => $limbah)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $limbah->jenis_limbah }}</td>
                <td>{{ $limbah->satuan_limbah }}</td>
                <td>{{ $limbah->tanggal_masuk }}</td>
                <td>{{ $limbah->sumber_limbahB3 }}</td>
                <td>{{ $limbah->bentuk_limbahB3 }}</td>
                <td>{{ $limbah->maksimal_penyimpanan }}</td>
                <td>{{ $limbah->jumlah_limbah }}</td>
                <td>{{ $limbah->berat_satuan }}</td>
                <td>{{ $limbah->berat }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<div style="margin-top: 20px;">
    @php
        $lastUserId = null; // Inisialisasi variabel untuk menyimpan id_user terakhir
        $lastSignature = null; // Inisialisasi variabel untuk menyimpan tanda tangan terakhir
    @endphp

    @foreach($limbahMasuk as $limbah)
        @php
            // Simpan id_user dan tanda tangan pada setiap iterasi
            $lastUserId = $limbah->id_user;
            $lastSignature = $limbah->tandaTangan;
        @endphp
    @endforeach

    <!-- Cek apakah ada tanda tangan untuk id_user terakhir -->
    <p>Data Tanda Tangan:</p>
    @if($lastSignature && is_object($lastSignature))
        <img src="{{ public_path('storage/'.$lastSignature->path) }}" alt="Tanda Tangan {{ $lastSignature->user->name }}" width="150">
        <p>{{ $lastSignature->user->name }}</p>
    @else
        <p>Tidak Ada Tanda Tangan untuk User ini</p>
    @endif
</div>

