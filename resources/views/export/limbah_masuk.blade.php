<!-- resources/views/exports/limbah_masuk.blade.php -->

@extends('export.limbah_masuk_title')

<table>
    <thead>
        <tr>
            <th>No aku</th>
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
