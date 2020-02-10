<div class="form-group row">
    <label for="tanggal_transaksi" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Transaksi') }}</label>

    <div class="col-md-6">
        <input id="tanggal_transaksi" type="text" class="form-control @error('tanggal_transaksi') is-invalid @enderror" name="tanggal_transaksi" value="{{ old('tanggal_transaksi', isset($model->tanggal_transaksi) ? date('d-m-Y', strtotime($model->tanggal_transaksi)) : date('d-m-Y')) }}" placeholder="Contoh: 20-12-2020" >

        @error('tanggal_transaksi')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="nominal" class="col-md-4 col-form-label text-md-right">{{ __('Nominal') }}</label>

    <div class="col-md-6">
        <input id="nominal" type="text" class="form-control @error('nominal') is-invalid @enderror" name="nominal" value="{{ old('nominal', isset($model->nominal) ? $model->nominal : '') }}" placeholder="Contoh: 100000" >

        @error('nominal')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="kategori_id" class="col-md-4 col-form-label text-md-right">{{ __('Kategori') }}</label>

    <div class="col-md-6">
        <select id="kategori_id" name="kategori_id" class="form-control @error('kategori_id') is-invalid @enderror">
            <option value="" >--Pilih Tipe--</option>
            @foreach ($category as $value)
                <option value="{{ $value->id }}"
                @if ($value->id == old('kategori_id', isset($model->kategori_id) ? $model->kategori_id : ''))
                    selected="selected"
                @endif
                >{{ $value->nama }}</option>
            @endforeach
        </select>
        @error('kategori_id')
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

