@extends('layouts.app')

@section('content')
<div class="row" >
    <div class="col-12" >
        <h3 class="text-center">Ubah Kategori</h3>
        <form method="post" id="admin-location" action="{{ route('update.kategori', $id) }}"  >
            @csrf
            @include('kategori.form', ['button' => 'Simpam Perubahan', 'mode' => 'update', 'model' => $model, 'id' => $id])
        </form>
    </div>
</div>
@endsection
