

<table>
    <thead>
        <tr>
            <th>No </th>
            <th>Jenis Limbah B3</th>
            <th>Jumlah KG</th>
            <th>Jumlah Ton</th>
            <th>Tujuan Penyerahan</th>
            <th>Bukti Nomor dokumen</th>
            <th>Sisa Lb 3</th>

        </tr>
    </thead>
    <tbody>
        @foreach($limbahkeluar as $index => $limbah)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $limbah->jenis_limbah }}</td>
                <td>{{ $limbah->jumlahkg }}</td>
                <td>{{ $limbah->jumlahton}}</td>
                <td>{{ $limbah->tujuanPenyerahan }}</td>
                <td>{{ $limbah->buktiNomorDokumen }}</td>
                <td>{{ $limbah->sisa_lb3 }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
{{-- <div style="margin-top: 20px;">
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
</div> --}}

