@extends('layouts.app')

@section('content')
<div class="row" >
    <div class="col-12" >
        <h3 class="text-center">Tambah Transaksi</h3>
        <form method="post" id="admin-location" action="{{ route('store.transaksi') }}" >
            @csrf
            @include('transaksi.form', ['button' => 'Simpan', 'mode' => 'create'])
        </form>
    </div>
</div>
@endsection
