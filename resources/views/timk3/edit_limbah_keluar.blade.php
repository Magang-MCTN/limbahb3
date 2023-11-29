<!-- resources/views/dashboard/timlb3/edit_limbah_keluar.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="container pt-3 py-4">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <div class="row px-5">
                        <div class="col d-flex justify-content-center">
                            <div class="d-flex rounded-circle justify-content-center mx-3" style="border-radius: 50%; width: 30px; height: 30px; background-color: #097B96">
                                <i class="mdi mdi-clipboard-outline d-flex" style="color:white; align-items: center;"></i>
                            </div>
                            <h2 class="fw-bold d-flex" style="color: #097B96;">Edit Data Limbah Keluar</h2>
                        </div>
                    </div>
                    <hr>
            
                    <form method="POST" action="{{ route('limbah_keluar.update', $limbahkeluar->id_limbah_keluar) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col form-group">
                                <label for="id_jenis_limbah">Jenis Limbah</label>
                                <select name="id_jenis_limbah" class="form-select form-control">
                                    @foreach($jenisLimbahs as $jenisLimbah)
                                        <option value="{{ $jenisLimbah->id_jenis_limbah }}" {{ $limbahkeluar->id_jenis_limbah == $jenisLimbah->id_jenis_limbah ? 'selected' : '' }}>
                                            {{ $jenisLimbah->jenis_limbah }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                
                            <div class="col form-group">
                                <label for="tujuanPenyerahan">Tujuan Penyerahan</label>
                                <input type="text" name="tujuanPenyerahan" class="form-control" value="{{ $limbahkeluar->tujuanPenyerahan }}">
                            </div>
                
                            <div class="col form-group">
                                <label for="tanggal_keluar">Tanggal Keluar</label>
                                <input type="date" name="tanggal_keluar" class="form-control" value="{{ $limbahkeluar->tanggal_keluar }}">
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col form-group">
                                <label for="jumlahkg">Jumlah KG (hari)</label>
                                <input type="number" name="jumlahkg" class="form-control" value="{{ $limbahkeluar->jumlahkg }}">
                            </div>
                
                            <div class="col form-group">
                                <label for="sisa_lb3">Sisa Limbah B3</label>
                                <input type="text" name="sisa_lb3" class="form-control" value="{{ $limbahkeluar->sisa_lb3 }}">
                            </div>
                
                            <div class="col form-group">
                                <label for="buktiNomorDokumen">Bukti Nomor Dokumen</label>
                                <input type="text" name="buktiNomorDokumen" class="form-control" value="{{ $limbahkeluar->buktiNomorDokumen }}">
                            </div>
                        </div>
                        <!-- Tambahkan form input untuk atribut lainnya sesuai kebutuhan -->
            
                        <button type="submit" class="btn" style="background-color:#097B96; color: white" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
