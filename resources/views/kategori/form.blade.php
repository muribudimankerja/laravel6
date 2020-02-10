<div class="form-group row">
    <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

    <div class="col-md-6">
        <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', isset($model->nama) ? $model->nama : '') }}" placeholder="Contoh: Belanja" >

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="tipe" class="col-md-4 col-form-label text-md-right">{{ __('Kategori') }}</label>

    <div class="col-md-6">
        <select id="tipe" name="tipe" class="form-control @error('tipe') is-invalid @enderror">
            <option value="" >--Pilih Tipe--</option>
            @foreach (['pemasukan' => 'Pemasukan', 'pengeluaran' => 'pengeluaran'] as $key => $value)
                <option value="{{ $key }}"
                @if ($key == old('tipe', isset($model->tipe) ? $model->tipe : ''))
                    selected="selected"
                @endif
                >{{ $value }}</option>
            @endforeach
        </select>
        @error('tipe')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="deskripsi" class="col-md-4 col-form-label text-md-right">{{ __('Deskripsi') }}</label>

    <div class="col-md-6">
        <textarea id="deskripsi" type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" placeholder="Contoh: Belanja Bulanan">{{ old('deskripsi', isset($model->deskripsi) ? $model->deskripsi : '') }}</textarea>

        @error('deskripsi')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-4">
        <button type="submit" class="btn btn-rounded btn-outline-primary" >{{$button}}</button>
    </div>
</div>

