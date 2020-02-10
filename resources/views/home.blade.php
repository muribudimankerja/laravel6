@extends('layouts.app')

@section('content')
<div class="row" >
    <div class="col-12" >
        <h3 class="text-center">Transaksi</h3>
        <br><br>
        <div class="row">
            <div class="col-12">
                <div class="alert alert-success">
                    <h1>Total Pemasukan : Rp.{{number_format($totalLemasukan)}}</h1>
                    <h1>Total Pengeluaran : Rp.{{number_format($totalPengeluaran)}}</h1>
                    <h1>Saldo : Rp.{{number_format($totalLemasukan - $totalPengeluaran)}}</h1>
                </div>
            </div>
        </div>
        <br><br>
        <form class="app-search" method="GET" action="{{ route('home') }}" >
            <div class="row" >
                <div class="col-md-3"> 
                    <input type="text" class="form-control" placeholder="dari : 01-01-2020" name="dari" value="{{isset($dari) ? $dari : ''}}">
                </div> 
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="sampai : 15-01-2020" name="sampai" value="{{isset($sampai) ? $sampai : ''}}">
                </div>
                
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary" >Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>
<br><br>

<div class="row" >
    <div class="col-12" >
        <div class="table-responsive">
            <table class="table  table-bordered full-color-table full-danger-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($model as $value)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$value->kategori_nama}}</td>
                        <td>{{date('d-m-Y', strtotime($value->tanggal_transaksi))}}</td>
                        <td class="text-right">@if($value->masuk > 0 )Rp.{{number_format($value->masuk)}}@endif</td>
                        <td class="text-right">@if($value->keluar > 0 )Rp.{{number_format($value->keluar)}}@endif</td>
                        <td>{{substr($value->deskripsi, 0, 10)}} ...</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td class="text-right" colspan="3">Jumlah:</td>
                        <td class="text-right">Rp.{{number_format($masuk)}}</td>
                        <td class="text-right">Rp.{{number_format($keluar)}}</td>
                        <td class="text-right"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@endsection
