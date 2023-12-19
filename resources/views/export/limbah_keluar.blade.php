<table>
    <thead>
        <tr>
            <th colspan="7" style="background-color: #00b0f0"><b>KELUARNYA LIMBAH B3 KE TPS</b></th>
        </tr>
        <tr>
            <th rowspan="2"><b>No</b></th>
            <th rowspan="2"><b>Jenis Limbah B3</b></th>
            <th colspan="2"><b>Jumlah Limbah B3</b></th>
            <th rowspan="2"><b>Tujuan Penyerahan</b></th>
            <th rowspan="2"><b>Bukti Nomor dokumen</b></th>
            <th rowspan="2"><b>Sisa Lb 3</b></th>

        </tr>
        <tr>
            <th><b>Kg</b></th>
            <th><b>Ton</b></th>
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
<div style="margin-top: 20px;">

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
<p>Duri, {{tgl_indo($periodes)}}</p>
 <!-- Cetak nilai variabel untuk debugging -->
@if($tandaTangan && is_object($tandaTangan))
    <img src="{{ public_path('storage/'.$tandaTangan->path) }}" alt="Tanda Tangan {{ $tandaTangan->user->name }}" width="150">
    <p>{{ $tandaTangan->user->name }}</p>
@else
    <p>Tidak Ada Tanda Tangan untuk User dengan role 4</p>
@endif

