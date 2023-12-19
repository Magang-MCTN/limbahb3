@extends('dashboard.app')

@section('content')
{{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> --}}
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="container py-3 px-4">
            <div class="content-wrapper">
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
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row px-5">
                                <div class="col d-flex justify-content-center">
                                    <div class="d-flex rounded-circle justify-content-center mx-3" style="border-radius: 50%; width: 30px; height: 30px; background-color: #097B96">
                                        <i class="mdi mdi-clipboard-outline d-flex" style="color:white; align-items: center;"></i>
                                    </div>
                                    <h2 class="fw-bold d-flex" style="color: #097B96;">Formulir Pengisian Limbah B3 Masuk</h2>
                                </div>
                            </div>
                            <hr>

                            <!-- Formulir Limbah Masuk -->
                            <form id="form-limbah-masuk">
                                @csrf
                                <div class="row mb-3 form-group">
                                    <label for="id_jenis_limbah" class="form-label">Jenis Limbah B3</label>
                                    <div class="col-md-8 col-sm-6">
                                        <div class="form-group">
                                            <select name="id_jenis_limbah" class="form-select form-control" required>
                                                <option value="" selected>Pilih</option>
                                                @foreach($jenisLimbah as $limbah)
                                                <option value="{{ $limbah->id_jenis_limbah }}">{{ $limbah->jenis_limbah }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <a type="button" class="btn btn-sm btn-mctn" data-toggle="modal" data-target="#modalTambahJenisLimbah" style="font-size: 20px">+</a>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col form-group">
                                        <label for="bentuk_limbahB3" class="form-label">Bentuk Limbah B3</label>
                                        <select name="bentuk_limbahB3" class="form-select form-control" required>
                                            <option value="" selected disabled>Pilih</option>
                                            <option value="liquid">Liquid</option>
                                            <option value="solid">Solid</option>
                                        </select>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                            <input type="date" name="tanggal_masuk" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="maksimal_penyimpanan" class="form-label">Maksimal Penyimpanan (hari)</label>
                                            <input type="number" name="maksimal_penyimpanan" class="form-control" placeholder="Penyimpanan (hari)" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col form-group">
                                        <label for="sumber_limbahB3" class="form-label">Sumber Limbah B3</label>
                                        <input type="text" name="sumber_limbahB3" class="form-control" placeholder="Sumber" required>
                                    </div>
                                    <div class="col">
                                        <div class="form-group" class="form-label">
                                            <label for="satuan_limbah">Satuan Limbah B3</label>
                                            <select name="satuan_limbah" id="satuan_limbah" class="form-select form-control" required>
                                                <option value="" selected disabled>Pilih</option>
                                                <option value="Bag">Bag</option>
                                                <option value="Drum">Drum</option>
                                                <option value="Ea">Ea</option>
                                                <option value="Lot">Lot</option>
                                                <option value="Pail">Pail</option>
                                                <option value="Pcs">Pcs</option>
                                                <option value="Unit">Unit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col form-group">
                                                <label for="jumlah_limbah">Jumlah Limbah B3</label>
                                                <input type="number" name="jumlah_limbah" class="form-control" placeholder="Jumlah" required>
                                            </div>
                                            <div class="col form-group">
                                                <label for="berat_satuan">Berat/Satuan (Kg)</label>
                                                <input type="number" name="berat_satuan" class="form-control" placeholder="Berat/Satuan" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                    <label for="id_periode_laporan">ID Periode</label>
                                    <input type="text" name="id_periode_laporan" value="{{ optional($periodeLaporan)->id_periode_laporan }}">
                                    {{-- {{ optional($periodeLaporan)->id_periode_laporan }} --}}
                                </div>

                                <!-- ... (Form input lainnya) -->

                                <div class="d-flex justify-content-end mt-3">
                                    <button class="btn" style="background-color: #097B96; color: white;" type="button" id="tambahData" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Tambah</button>
                                </div>
                            </form>

                            <!-- Modal untuk menambah jenis limbah -->
                            <div class="modal fade" id="modalTambahJenisLimbah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold" id="exampleModalLabel">Tambah Jenis Limbah B3 Baru</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form untuk menambah jenis limbah -->
                                            <form action="{{ route('jenislimbah.store') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="jenis_limbah">Jenis Limbah B3</label>
                                                    <input type="text" name="jenis_limbah" class="form-control" required>
                                                    <button type="submit" class="btn btn-sm btn-mctn mt-2">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Tabel Sementara Limbah Masuk -->
                            <div class="table-responsive">
                                <table class="table mt-4">
                                    <thead>
                                        <tr>
                                            <th>ID Periode </th>
                                            <th>Jenis Limbah B3</th>
                                            <th>Satuan Limbah B3</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Maksimal Penyimpanan (hari)</th>
                                            <th>Sumber Limbah B3</th>
                                            <th>Bentuk Limbah B3</th>
                                            <th>Jumlah Limbah B3</th>
                                            <th>Berat/Satuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tabelSementara">
                                        <!-- Data limbah masuk yang ditambahkan akan muncul di sini -->
                                    </tbody>
                                </table>
                            </div>

                            <div class="d-flex justify-content-between mt-3">
                                <a href="{{ route('timlb3.import-form', [$periodeLaporan ->id_periode_laporan]) }}" class="btn btn-primary">
                                    Import Excel Limbah B3 Masuk
                                </a>
                                <button class="btn btn-success" type="button" id="submitFormLimbahMasuk" style="background-color:#097B96; color: white" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script AJAX untuk Mengirim Data Limbah Masuk -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        let dataLimbahMasuk = []; // Array untuk menyimpan data limbah masuk sementara

        $('#tambahData').click(function () {
            // Ambil data dari input
            let id_periode_laporan = $('[name="id_periode_laporan"]').val();
            let id_jenis_limbah = $('[name="id_jenis_limbah"]').val();
            let satuan_limbah = $('[name="satuan_limbah"]').val();
            let tanggal_masuk = $('[name="tanggal_masuk"]').val();
            let maksimal_penyimpanan = $('[name="maksimal_penyimpanan"]').val();
            let sumber_limbahB3 = $('[name="sumber_limbahB3"]').val();
            let bentuk_limbahB3 = $('[name="bentuk_limbahB3"]').val();
            let jumlah_limbah = $('[name="jumlah_limbah"]').val();
            let berat_satuan = $('[name="berat_satuan"]').val();

            // Tambahkan data ke array
            dataLimbahMasuk.push({
                id_periode_laporan,
                id_jenis_limbah,
                satuan_limbah,
                tanggal_masuk,
                maksimal_penyimpanan,
                sumber_limbahB3,
                bentuk_limbahB3,
                jumlah_limbah,
                berat_satuan,
            });

            // Tambahkan data limbah masuk ke tabel sementara
            let newRow = `<tr>
                <td>${id_periode_laporan}</td>
                <td>${id_jenis_limbah}</td>
                <td>${satuan_limbah}</td>
                <td>${tanggal_masuk}</td>
                <td>${maksimal_penyimpanan}</td>
                <td>${sumber_limbahB3}</td>
                <td>${bentuk_limbahB3}</td>
                <td>${jumlah_limbah}</td>
                <td>${berat_satuan}</td>
                <td><button class="hapus btn btn-sm btn-danger">Hapus</button></td>
            </tr>`;
            $('#tabelSementara').append(newRow);

            // Bersihkan input
            $('#form-limbah-masuk')[0].reset();
        });

        // Aksi hapus data limbah masuk
        $('#tabelSementara').on('click', 'button.hapus', function () {
            let index = $(this).closest('tr').index();
            // Hapus data limbah masuk dari array dan baris dari tabel
            dataLimbahMasuk.splice(index, 1);
            $(this).closest('tr').remove();
        });

        // Tombol "Simpan Limbah Masuk"
        $('#submitFormLimbahMasuk').click(function () {
            if (dataLimbahMasuk.length > 0) {
                // Persiapkan data yang akan dikirim
                let formDataLimbahMasuk = new FormData();
                formDataLimbahMasuk.append('_token', $('input[name="_token"]').val());

                // Tambahkan data limbah masuk ke FormData
                $.each(dataLimbahMasuk, function (key, value) {
                    formDataLimbahMasuk.append(`dataLimbahMasuk[${key}][id_jenis_limbah]`, value.id_jenis_limbah);
                    formDataLimbahMasuk.append(`dataLimbahMasuk[${key}][satuan_limbah]`, value.satuan_limbah);
                    formDataLimbahMasuk.append(`dataLimbahMasuk[${key}][tanggal_masuk]`, value.tanggal_masuk);
                    formDataLimbahMasuk.append(`dataLimbahMasuk[${key}][maksimal_penyimpanan]`, value.maksimal_penyimpanan);
                    formDataLimbahMasuk.append(`dataLimbahMasuk[${key}][sumber_limbahB3]`, value.sumber_limbahB3);
                    formDataLimbahMasuk.append(`dataLimbahMasuk[${key}][bentuk_limbahB3]`, value.bentuk_limbahB3);
                    formDataLimbahMasuk.append(`dataLimbahMasuk[${key}][jumlah_limbah]`, value.jumlah_limbah);
                    formDataLimbahMasuk.append(`dataLimbahMasuk[${key}][berat_satuan]`, value.berat_satuan);
                    formDataLimbahMasuk.append(`dataLimbahMasuk[${key}][id_periode_laporan]`, value.id_periode_laporan);
                });

                // Kirim data limbah masuk ke server menggunakan AJAX
                $.ajax({
                    url: "/timlb3/submit-limbah-masuk",
                    type: "POST",
                    data: formDataLimbahMasuk,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        // Respons dari server dapat berupa objek JSON yang mengandung informasi lebih lanjut
                        if (response.success) {
                            // Setelah data limbah masuk disimpan, bersihkan tabel sementara dan array data
                            dataLimbahMasuk = [];
                            $('#tabelSementara').empty();
                            alert('Data limbah masuk berhasil disimpan ke database.');
                            window.location.href = "/mctn";
                        } else {
                            alert('Terjadi kesalahan saat menyimpan data limbah masuk: ' + response.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        alert('Terjadi kesalahan saat menyimpan data limbah masuk.');
                    }
                });
            } else {
                alert('Tidak ada data limbah masuk untuk disimpan.');
            }
        });
    });
</script>
<!-- View pengisian limbah masuk -->

<!-- jQuery (pastikan Anda telah menyertakan jQuery) -->
{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> --}}



<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Sukses!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="successMessage"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
        </div>
      </div>
    </div>
  </div>
@endsection
