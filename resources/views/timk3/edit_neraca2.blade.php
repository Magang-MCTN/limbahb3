<!-- resources/views/edit_neraca2.blade.php -->

@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="container py-3 py-">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h3 class="fw-bold">Edit Neraca 2</h3>
            
                    <form action="{{ route('updateNeraca2', $neraca2->id_neraca_limbah_2) }}" method="POST">
                        @csrf
                        @method('PUT')
            
                        <div class="row">
                            <div class="col form-group">
                                <label for="total_neraca">Total Neraca</label>
                                <input type="text" class="form-control" id="total_neraca" name="total_neraca" value="{{ $neraca2->total_neraca }}">
                            </div>
                
                            <div class="col form-group">
                                <label for="residu">Residu</label>
                                <input type="text" class="form-control" id="residu" name="residu" value="{{ $neraca2->residu }}">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col form-group">
                                <label for="limbah_belum_dikelola">Limbah Belum Dikelola</label>
                                <input type="text" class="form-control" id="limbah_belum_dikelola" name="limbah_belum_dikelola" value="{{ $neraca2->limbah_belum_dikelola }}">
                            </div>
                
                            <div class="col form-group">
                                <label for="limbah_tersisa">Limbah Tersisa</label>
                                <input type="text" class="form-control" id="limbah_tersisa" name="limbah_tersisa" value="{{ $neraca2->limbah_tersisa }}">
                            </div>
                        </div>
            
                        <div class="form-group">
                            <label for="kinerja_pengelolaan">Kinerja Pengelolaan</label>
                            <input type="text" class="form-control" id="kinerja_pengelolaan" name="kinerja_pengelolaan" value="{{ $neraca2->kinerja_pengelolaan }}">
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="dokumen_kontrol">Dokumen Kontrol</label>
                                    <input type="text" class="form-control" id="dokumen_kontrol" name="dokumen_kontrol" value="{{ $neraca2->dokumen_kontrol }}">
                                </div>
                    
                                <div class="form-group">
                                    <label for="perizinan_limbah_klh">Perizinan Limbah KLH</label>
                                    <input type="text" class="form-control" id="perizinan_limbah_klh" name="perizinan_limbah_klh" value="{{ $neraca2->perizinan_limbah_klh }}">
                                </div>
                                <div class="form-group">
                                    <label for="no_izin_limbah_klh">No Izin Limbah KLH</label>
                                    <input type="text" class="form-control" id="no_izin_limbah_klh" name="no_izin_limbah_klh" value="{{ $neraca2->no_izin_limbah_klh }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                </div>
                                <div class="d-flex">
                                    <textarea class="border" id="catatan" name="catatan" style="width: 40vw; border:1px; border-radius: 5px" rows="8"> {{ $neraca2->catatan }}</textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn" style="background-color:#097B96; color: white" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
