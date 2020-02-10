<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'dari' => 'date|date_format:d-m-Y',
            'sampai' => 'date|date_format:d-m-Y|after_or_equal:dari',
        ]);
        
        $dari = $request->get('dari');
        $sampai = $request->get('sampai');
        
        $totalLemasukan = Transaksi::leftJoin('kategoris', 'kategoris.id', '=', 'transaksis.kategori_id')
                ->where('kategoris.tipe', 'pemasukan')
                ->sum('nominal');
        
        $totalPengeluaran = Transaksi::leftJoin('kategoris', 'kategoris.id', '=', 'transaksis.kategori_id')
                ->where('kategoris.tipe', 'pengeluaran')
                ->sum('nominal');
         
        $query = Transaksi::leftJoin('kategoris', 'kategoris.id', '=', 'transaksis.kategori_id')
                ->orderBy('transaksis.id', 'DESC');
        
        if($dari && $sampai) {
            $query->whereBetween('transaksis.tanggal_transaksi', [date('Y-m-d', strtotime($dari)), date('Y-m-d', strtotime($sampai))]);
        } else {
            $query->whereYear('transaksis.tanggal_transaksi', date('Y'))
                ->whereMonth('transaksis.tanggal_transaksi', date('m'));
        }
                
        
        $model = $query->select('transaksis.*', 'kategoris.nama as kategori_nama', 'kategoris.tipe as kategori_tipe')
                ->get();
        
        $masuk = 0;
        $keluar = 0;
        foreach($model as $key => $value) {
            if($value->kategori_tipe == 'pemasukan') {
                $model[$key]['masuk'] = $value->nominal;
                $model[$key]['keluar'] = 0;
                $masuk += $value->nominal;
            } else {
                $model[$key]['masuk'] = 0;
                $model[$key]['keluar'] = $value->nominal;
                $keluar += $value->nominal;
            }
        }

        return view('home',compact('model'))->with([
            'validatedData' => $validatedData,
            'dari' => $dari,
            'sampai' => $sampai,
            'masuk' => $masuk,
            'keluar' => $keluar,
            'totalLemasukan' => $totalLemasukan,
            'totalPengeluaran' => $totalPengeluaran,
            'i' => 1,
        ]);
    }
}
