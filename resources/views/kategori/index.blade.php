@extends('layouts.app')

@section('content')

<div class="row" >
    <div class="col-12" >
        <h3 class="text-center">Data Kategori</h3>
        <a href="{{route('create.kategori')}}" class="btn btn-rounded btn-outline-primary"> Tambah </a>
        <br><br>
        <form class="app-search" method="GET" action="{{ route('kategori') }}" >
            <input type="text" class="form-control" placeholder="Cari & tekan enter ..." name="search" value="{{isset($search) ? $search : ''}}"> 
            <a class="srh-btn"><i class="ti-close"></i></a> 
        </form>
    </div>
</div>
<br><br>

<div class="row" >
    <div class="col-12" >
        <div class="table-responsive">
            <table class="table table-bordered full-color-table full-danger-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Tipe</th>
                        <th>Deskripsi</th>
                        <th class="text-center" width="15%">Manipulation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($model as $value)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$value->nama}}</td>
                        <td>{{$value->tipe}}</td>
                        <td>{{$value->deskripsi}}</td>
                        <td class="text-center bg-white">
                            <a class="btn btn-rounded btn-outline-primary btn-sm" href="{{route('edit.kategori', $value->id)}}">Ubah</a>
                            <a class="btn btn-rounded btn-outline-danger btn-sm" href="{{route('destroy.kategori', $value->id)}}">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row" >
            <div class="col-12 text-center" >
                {{ $model->links() }}
            </div>
        </div>
    </div>
</div>
@endsection