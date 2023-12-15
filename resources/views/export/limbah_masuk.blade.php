<table>
    <tr>
        <th><b>No</b></th>
        <th><b>Jenis Limbah B3</b></th>
        <th><b>Satuan Limbah</b></th>
        <th><b>Tanggal Masuk Limbah B3</b></th>
        <th><b>Sumber Limbah B3</b></th>
        <th><b>Bentuk Limbah B3</b></th>
        <th><b>Maksimal Penyimpanan (180-360 hr)</b></th>
        <th><b>Jumlah</b></th>
        <th><b>Berat/Satuan</b></th>
        <th><b>Berat (kg)</b></th>
    </tr>
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

