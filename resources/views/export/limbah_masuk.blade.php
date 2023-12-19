<table style="text-align: justify">
    <tr>
        <th colspan="10" style="background-color: #00b0f0"><b>MASUKNYA LIMBAH B3 KE TPS</b></th>
    </tr>
    <tr>
        <th rowspan="2"><b>No</b></th>
        <th rowspan="2"><b>Jenis Limbah B3</b></th>
        <th rowspan="2"><b>Satuan Limbah</b></th>
        <th rowspan="2"><b>Tanggal Masuk Limbah B3</b></th>
        <th rowspan="2"><b>Sumber Limbah B3</b></th>
        <th rowspan="2"><b>Bentuk Limbah B3</b></th>
        <th colspan="3"><b>Jumlah Limbah B3 Masuk</b></th>
        <th rowspan="2"><b>Maksimal Penyimpanan (180-360 hr)</b></th>
    </tr>
    <tr>
        <th><b>Jumlah</b></th>
        <th><b>Berat/Satuan</b></th>
        <th><b>Berat (kg)</b></th>
    </tr>

    @foreach($limbahMasuk as $index => $limbah)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td style="width: 1000%">{{ $limbah->jenisLimbah->jenis_limbah }}</td>
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

    <?php
    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
    ?>
    <!-- Cek apakah ada tanda tangan untuk id_user terakhir -->
    <p>Duri, {{ tgl_indo($periodes) }}<p>
    @if($lastSignature && is_object($lastSignature))
        <img src="{{ public_path('storage/'.$lastSignature->path) }}" alt="Tanda Tangan {{ $lastSignature->user->name }}" width="150">
        <p>{{ $lastSignature->user->name }}</p>
    @else
        <p>Tidak Ada Tanda Tangan untuk User ini</p>
    @endif
</div>

{{-- <p>Tanggal/Waktu: <span id="tanggalwaktu"></span></p> --}}
<script>
var dt = new Date();
document.getElementById("tanggalwaktu").innerHTML = dt.toLocaleString();
</script>

