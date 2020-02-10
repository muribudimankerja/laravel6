@extends('layouts.app')

@section('content')

<div class="row" >
    <div class="col-12" >
        <h3 class="text-center">Data Transaksi</h3>
        <a href="{{route('create.transaksi')}}" class="btn btn-rounded btn-outline-primary"> Tambah </a>
        <br><br>
        <form class="app-search" method="GET" action="{{ route('transaksi') }}" >
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
                        <th>Kategori</th>
                        <th>Tipe</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                        <th>Deskripsi</th>
                        <th class="text-center" width="15%">Manipulation</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($model as $value)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$value->kategori_nama}}</td>
                        <td>{{$value->kategori_tipe}}</td>
                        <td>{{date('d-m-Y', strtotime($value->tanggal_transaksi))}}</td>
                        <td class="text-right">Rp.{{number_format($value->nominal)}}</td>
                        <td>{{$value->deskripsi}}</td>
                        <td class="text-center bg-white">
                            <a class="btn btn-rounded btn-outline-primary btn-sm" href="{{route('edit.transaksi', $value->id)}}">Ubah</a>
                            <a class="btn btn-rounded btn-outline-danger btn-sm" href="{{route('destroy.transaksi', $value->id)}}">Hapus</a>
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