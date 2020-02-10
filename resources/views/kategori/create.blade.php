@extends('layouts.app')

@section('content')
<div class="row" >
    <div class="col-12" >
        <h3 class="text-center">Tambah Kategori</h3>
        <form method="post" id="admin-location" action="{{ route('store.kategori') }}" >
            @csrf
            @include('kategori.form', ['button' => 'Simpan', 'mode' => 'create'])
        </form>
    </div>
</div>
@endsection
