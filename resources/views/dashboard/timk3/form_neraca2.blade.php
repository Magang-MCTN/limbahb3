<!-- resources/views/dashboard/timk3/form_neraca2.blade.php -->

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
                                <h2 class="fw-bold d-flex" style="color: #097B96;">Formulir Pelaporan Neraca Limbah</h2>
                            </div>
                        </div>
                        <hr>
    
                        <form method="post" action="{{ route('timk3.submitFormNeraca2', $bulan->id_bulan) }}">
                            @csrf
                            <!-- Total Neraca -->
                            <div class="row mb-2">
                                <span class="fw-bold">Jumlah (ton)</span>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="total_neraca">Total</label>
                                    <input type="number" name="total_neraca" class="form-control" placeholder="B + ()" required>
                                </div>
    
                                <!-- Residu -->
                                <div class="col form-group">
                                    <label for="residu">Residu</label>
                                    <input type="number" name="residu" class="form-control" placeholder="C(+) ...()... TON" required>
                                </div>
                            </div>
    
                            <div class="row">
                                <!-- Limbah Belum Dikelola -->
                                <div class="col form-group">
                                    <label for="limbah_belum_dikelola">Limbah Belum Dikelola</label>
                                    <input type="number" name="limbah_belum_dikelola" class="form-control" placeholder="D (+) ...()... TON" required>
                                </div>
    
                                <!-- Limbah Tersisa -->
                                <div class="col form-group">
                                    <label for="limbah_tersisa">Total Limbah yang Tersisa</label>
                                    <input type="number" name="limbah_tersisa" class="form-control" placeholder="(C + D)...()... TON" required>
                                </div>
                            </div>
    
                            <div class="row">
                                <!-- Kinerja Pengelolaan -->
                                <div class="col form-group">
                                    <label for="kinerja_pengelolaan">Kinerja Pengelolaan</label>
                                    <input type="number" name="kinerja_pengelolaan" class="form-control" placeholder="( {A-(C+D)}/A)*100% )" required>
                                </div>
                            </div>
    
                            
                            <div class="row">
                                <div class="col">
                                    <!-- Dokumen Kontrol -->
                                    <div class="row form-group">
                                        <label for="dokumen_kontrol">Dokumen Kontrol</label>
                                        <div class="ps-3">
                                            <input type="text" name="dokumen_kontrol" class="form-control" required>
                                        </div>
                                    </div>
    
                                    <!-- Perizinan Limbah KLH -->
                                    <div class="row form-group">
                                        <label for="perizinan_limbah_klh">Perizinan Limbah KLH</label>
                                        <div class="col form-check ps-5">
                                            <input class="form-check-input" type="radio" name="perizinan_limbah_klh" value="ada" required>
                                            <label class="form-check-label">Ada</label>
                                        </div>
                                        <div class="col form-check ps-5">
                                            <input class="form-check-input" type="radio" name="perizinan_limbah_klh" value="tidak" required>
                                            <label class="form-check-label">Tidak</label>
                                        </div>
                                        <div class="col form-check ps-5">
                                            <input class="form-check-input" type="radio" name="perizinan_limbah_klh" value="kedaluarsa" required>
                                            <label class="form-check-label">Kadaluarsa</label>
                                        </div>
                                    </div>
    
                                    <!-- Textarea untuk No Izin Limbah KLH -->
                                    <div class="row form-group">
                                        <label for="no_izin_limbah_klh">No Izin Limbah KLH</label>
                                        <div class="d-flex ps-3">
                                            <textarea name="no_izin_limbah_klh" class="border" style="width: 33vw; border: 1px; border-radius: 5px;" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>
    
                                <!-- Catatan -->
                                <div class="col ms-2">
                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <div class="">
                                            <textarea name="catatan" class="border" style="width: 35vw; border:1px; border-radius: 5px" rows="13"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-mctn" type="submit" style="background-color:#097B96; color: white" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
