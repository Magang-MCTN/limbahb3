@extends('dashboard.app')

@section('content')
<div class="main-panel">
    <div class="container py-3 px-4">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h3 class="fw-bold">Edit Data Neraca 1</h3>

                    <form method="POST" action="{{ route('timk3.updateNeraca1', $neraca1->id_neraca_limbah_1) }}">
                        @csrf
                        @method('PUT')

                        <!-- Tambahkan input fields sesuai dengan atribut Neraca 1 -->

                        <div class="row">
                            <div class="col form-group col-sm-6 col-md-8">
                                <label for="id_jenis_limbah">Jenis Limbah</label>
                                <select class="form-control" id="id_jenis_limbah" name="id_jenis_limbah">
                                    @foreach($jenisLimbahs as $jenisLimbah)
                                        <option value="{{ $jenisLimbah->id_jenis_limbah }}" {{ $neraca1->id_jenis_limbah == $jenisLimbah->id_jenis_limbah ? 'selected' : '' }}>
                                            {{ $jenisLimbah->jenis_limbah }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col form-group col-sm-6 col-md-4">
                                <label for="sumber_limbah">Sumber Limbah</label>
                                <input type="text" class="form-control" id="sumber_limbah" name="sumber_limbah" value="{{ $neraca1->sumber_limbah }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <label for="sumber_limbah">Dihasilkan</label>
                                <input type="text" class="form-control" id="dihasilkan" name="dihasilkan" value="{{ $neraca1->dihasilkan }}">
                            </div>
                            <div class="col form-group">
                                <label for="disimpan">Disimpan</label>
                                <input type="text" class="form-control" id="disimpan" name="disimpan" value="{{ $neraca1->disimpan }}">
                            </div>
                            <div class="col form-group">
                                <label for="sumber_limbah">Dimanfaatkan</label>
                                <input type="text" class="form-control" id="dimanfaatkan" name="dimanfaatkan" value="{{ $neraca1->dimanfaatkan }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="sumber_limbah">Diolah</label>
                                <input type="text" class="form-control" id="diolah" name="diolah" value="{{ $neraca1->diolah }}">
                            </div>
                            <div class="col form-group">
                                <label for="sumber_limbah">Dtimbun</label>
                                <input type="text" class="form-control" id="ditimbun" name="ditimbun" value="{{ $neraca1->ditimbun }}">
                            </div>
                            <div class="col form-group">
                                <label for="sumber_limbah">Diserahkan ke Pihak Ketiga</label>
                                <input type="text" class="form-control" id="diserahkan" name="diserahkan" value="{{ $neraca1->diserahkan }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="sumber_limbah">Ekspor</label>
                                <input type="text" class="form-control" id="eksport" name="eksport" value="{{ $neraca1->eksport}}">
                            </div>
                            <div class="col form-group">
                                <label for="sumber_limbah">Lainnya</label>
                                <input type="text" class="form-control" id="lainnya" name="lainnya" value="{{ $neraca1->lainnya}}">
                            </div>
                            <div class="col"></div>
                        </div>
                        <!-- Tambahkan input fields lainnya -->

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn" style="background-color:#097B96; color: white" onmouseover="this.style.backgroundColor='#0B697F'" onmouseout="this.style.backgroundColor='#097B96'">Perbarui Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
ss
