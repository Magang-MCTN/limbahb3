@extends('dashboard.app')

@section('content')
    <div class="container">
        <h2>Edit Data Neraca 1</h2>

        <form method="POST" action="{{ route('timk3.updateNeraca1', $neraca1->id_neraca_limbah_1) }}">
            @csrf
            @method('PUT')

            <!-- Tambahkan input fields sesuai dengan atribut Neraca 1 -->
            <div class="form-group">
                <label for="id_jenis_limbah">Jenis Limbah</label>
                <select class="form-control" id="id_jenis_limbah" name="id_jenis_limbah">
                    @foreach($jenisLimbahs as $jenisLimbah)
                        <option value="{{ $jenisLimbah->id_jenis_limbah }}" {{ $neraca1->id_jenis_limbah == $jenisLimbah->id_jenis_limbah ? 'selected' : '' }}>
                            {{ $jenisLimbah->jenis_limbah }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="sumber_limbah">Sumber Limbah</label>
                <input type="text" class="form-control" id="sumber_limbah" name="sumber_limbah" value="{{ $neraca1->sumber_limbah }}">
            </div>
            <div class="form-group">
                <label for="sumber_limbah">Dihasilkan</label>
                <input type="text" class="form-control" id="dihasilkan" name="dihasilkan" value="{{ $neraca1->dihasilkan }}">
            </div>
            <div class="form-group">
                <label for="sumber_limbah">Dimanfaatkan</label>
                <input type="text" class="form-control" id="dimanfaatkan" name="dimanfaatkan" value="{{ $neraca1->dimanfaatkan }}">
            </div>
            <div class="form-group">
                <label for="sumber_limbah">Diolah</label>
                <input type="text" class="form-control" id="diolah" name="diolah" value="{{ $neraca1->diolah }}">
            </div>
            <div class="form-group">
                <label for="sumber_limbah">Dtimbun</label>
                <input type="text" class="form-control" id="ditimbun" name="ditimbun" value="{{ $neraca1->ditimbun }}">
            </div>
            <div class="form-group">
                <label for="sumber_limbah">Diserahkan</label>
                <input type="text" class="form-control" id="diserahkan" name="diserahkan" value="{{ $neraca1->diserahkan }}">
            </div>
            <div class="form-group">
                <label for="sumber_limbah">Eksport</label>
                <input type="text" class="form-control" id="eksport" name="eksport" value="{{ $neraca1->eksport}}">
            </div>
            <div class="form-group">
                <label for="sumber_limbah">Lainnya</label>
                <input type="text" class="form-control" id="lainnya" name="lainnya" value="{{ $neraca1->lainnya}}">
            </div>

            <!-- Tambahkan input fields lainnya -->

            <button type="submit" class="btn btn-primary">Perbarui Data</button>
        </form>
    </div>
@endsection
