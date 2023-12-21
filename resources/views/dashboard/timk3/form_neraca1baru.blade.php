<!-- resources/views/dashboard/timk3/form_neraca1.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container py-3 px-4">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        <div class="row px-5">
                            <div class="col d-flex justify-content-center">
                                <div class="d-flex rounded-circle justify-content-center mx-3" style="border-radius: 50%; width: 30px; height: 30px; background-color: #097B96">
                                    <i class="mdi mdi-clipboard-outline d-flex" style="color:white; align-items: center;"></i>
                                </div>
                                <h2 class="fw-bold d-flex" style="color: #097B96;">Formulir Pelaporan Neraca Limbah B3</h2>
                            </div>
                        </div>
                        <hr>

                        <form id="form-neraca1">
                            @csrf
                            <div class="row">
                                <div class="col form-group col-sm-6 col-md-8">
                                    <label for="id_jenis_limbah">Jenis Limbah B3</label>
                                    <select name="id_jenis_limbah" class="form-select form-control" required>
                                        <option value="" selected disabled>Pilih</option>
                                        @foreach($jenisLimbah as $limbah)
                                        <option value="{{ $limbah->id_jenis_limbah }}">{{ $limbah->jenis_limbah }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col form-group col-sm-6 col-md-4">
                                    <label for="sumber">Sumber</label>
                                    <select name="sumber" class="form-select form-control" required>
                                        <option value="" selected disabled>Pilih</option>
                                        <option value="Diluar Proses Produksi">Diluar Proses Produksi</option>
                                        <option value="Proses Produksi">Proses Produksi</option>
                                        <option value="Gabungan">Gabungan</option>
                                        <!-- Tambahkan opsi lainnya sesuai kebutuhan -->
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <span class="fw-bold">Jumlah (Ton)</span>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="dihasilkan">Dihasilkan</label>
                                    <input type="number" name="dihasilkan" class="form-control" required>
                                </div>
                                <div class="col form-group">
                                    <label for="disimpan">Disimpan</label>
                                    <input type="number" name="disimpan" class="form-control" required>
                                </div>
                                <div class="col form-group">
                                    <label for="dimanfaatkan">Dimanfaatkan</label>
                                    <input type="number" name="dimanfaatkan" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <label for="diolah">Diolah</label>
                                    <input type="number" name="diolah" class="form-control" required>
                                </div>
                                <div class="col form-group">
                                    <label for="ditimbun">Ditimbun</label>
                                    <input type="number" name="ditimbun" class="form-control" required>
                                </div>
                                <div class="col form-group">
                                    <label for="diserahkan">Diserahkan Pihak Ketiga</label>
                                    <input type="number" name="diserahkan" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <label for="eksport">Eksport</label>
                                    <input type="number" name="eksport" class="form-control" required>
                                </div>
                                <div class="col form-group">
                                    <label for="lainnya">Lainnya</label>
                                    <input type="number" name="lainnya" class="form-control" required>
                                </div>
                                <div class="col">
                                </div>
                            </div>
                            <!-- Tambahkan form input lainnya sesuai kebutuhan -->
                        </form>
                        <div class="d-flex justify-content-end">
                            <button class="btn" type="button" id="tambahDataNeraca1" style="background-color:#097B96; color: white" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Tambah</button>
                        </div>

                        <!-- Tabel Sementara Neraca 1 -->
                        <div class="table-responsive">
                            <table class="table mt-4">
                                <thead>
                                    <tr>
                                        <th>Jenis Limbah B3</th>
                                        <th>Sumber</th>
                                        <th>Dihasilkan</th>
                                        <th>Disimpan</th>
                                        <th>Dimanfaatkan</th>
                                        <th>Diolah</th>
                                        <th>Ditimbun</th>
                                        <th>Diserahkan Pihak Ketiga</th>
                                        <th>Ekspor</th>
                                        <th>Lainnya</th>

                                        <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="tabelSementaraNeraca1">
                                    <!-- Data neraca 1 yang ditambahkan akan muncul di sini -->
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-end mt-3">
                            <button class="btn btn-success" type="button" id="submitFormNeraca1" style="background-color:#097B96; color: white" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Script AJAX untuk Mengirim Data Neraca 1 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            let dataNeraca1 = []; // Array untuk menyimpan data neraca 1 sementara

            $('#tambahDataNeraca1').click(function () {
                // Ambil data dari input Neraca 1
                let id_jenis_limbah = $('[name="id_jenis_limbah"]').val();
                let sumber = $('[name="sumber"]').val();
                let dihasilkan = $('[name="dihasilkan"]').val();
                let disimpan = $('[name="disimpan"]').val();
                let dimanfaatkan = $('[name="dimanfaatkan"]').val();
                let diolah = $('[name="diolah"]').val();
                let ditimbun = $('[name="ditimbun"]').val();
                let diserahkan = $('[name="diserahkan"]').val();
                let eksport = $('[name="eksport"]').val();
                let lainnya = $('[name="lainnya"]').val();
                // Tambahkan data ke array
                dataNeraca1.push({
                    id_jenis_limbah,
                    sumber,
                    dihasilkan,
                    disimpan,
                    dimanfaatkan,
                    diolah,
                    ditimbun,
                    diserahkan,
                    eksport,
                    lainnya
                });

                // Tambahkan data Neraca 1 ke tabel sementara
                let newRow = `<tr>
                    <td>${id_jenis_limbah}</td>
                    <td>${sumber}</td>
                    <td>${dihasilkan}</td>
                    <td>${disimpan}</td>
                    <td>${dimanfaatkan}</td>
                    <td>${diolah}</td>
                    <td>${ditimbun}</td>
                    <td>${diserahkan}</td>
                    <td>${eksport}</td>
                    <td>${lainnya}</td>
                    <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
                    <td><button class="hapusNeraca1">Hapus</button></td>
                </tr>`;
                $('#tabelSementaraNeraca1').append(newRow);

                // Bersihkan input Neraca 1
                $('#form-neraca1')[0].reset();
            });

            // Aksi hapus data Neraca 1
            $('#tabelSementaraNeraca1').on('click', 'button.hapusNeraca1', function () {
                let index = $(this).closest('tr').index();
                // Hapus data Neraca 1 dari array dan baris dari tabel
                dataNeraca1.splice(index, 1);
                $(this).closest('tr').remove();
            });

            // Tombol "Simpan Neraca 1"
            $('#submitFormNeraca1').click(function () {
                if (dataNeraca1.length > 0) {
                    // Persiapkan data yang akan dikirim
                    let formDataNeraca1 = new FormData();
                    formDataNeraca1.append('_token', $('input[name="_token"]').val());

                    // Tambahkan data Neraca 1 ke FormData
                    $.each(dataNeraca1, function (key, value) {
                        formDataNeraca1.append(`dataNeraca1[${key}][id_jenis_limbah]`, value.id_jenis_limbah);
                        formDataNeraca1.append(`dataNeraca1[${key}][sumber]`, value.sumber);
                        formDataNeraca1.append(`dataNeraca1[${key}][dihasilkan]`, value.dihasilkan);
                        formDataNeraca1.append(`dataNeraca1[${key}][disimpan]`, value.disimpan);
                        formDataNeraca1.append(`dataNeraca1[${key}][dimanfaatkan]`, value.dimanfaatkan);
                        formDataNeraca1.append(`dataNeraca1[${key}][diolah]`, value.diolah);
                        formDataNeraca1.append(`dataNeraca1[${key}][ditimbun]`, value.ditimbun);
                        formDataNeraca1.append(`dataNeraca1[${key}][diserahkan]`, value.diserahkan);
                        formDataNeraca1.append(`dataNeraca1[${key}][eksport]`, value.eksport);
                        formDataNeraca1.append(`dataNeraca1[${key}][lainnya]`, value.lainnya);
                        // Tambahkan kolom lainnya sesuai kebutuhan
                    });

                    // Kirim data Neraca 1 ke server menggunakan AJAX
                    $.ajax({
                        url: "/timk3/submit-neraca1baru/{{ $bulan->id_bulan }}",
                        type: "POST",
                        data: formDataNeraca1,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            // Respons dari server dapat berupa objek JSON yang mengandung informasi lebih lanjut
                            if (response.success) {
                                // Setelah data Neraca 1 disimpan, bersihkan tabel sementara dan array data
                                dataNeraca1 = [];
                                $('#tabelSementaraNeraca1').empty();
                                alert('Data Neraca 1 berhasil disimpan ke database.');
                                window.location.href =  "/timk3/lihat-neraca-perbulan/" + {{ $bulan->id_bulan }};
                            } else {
                                window.location.href =  "/timk3/lihat-neraca-perbulan/" + {{ $bulan->id_bulan }};
                            }
                        },
                        error: function (xhr, status, error) {
                            alert('Terjadi kesalahan saat menyimpan data Neraca 1.');
                        }
                    });
                } else {
                    alert('Tidak ada data Neraca 1 untuk disimpan.');
                }
            });
        });
    </script>
@endsection
