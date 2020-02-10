<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Kategori;

class TransaksiController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = (int) 10;
        $search = $request->get('search');
         
        $query = Transaksi::leftJoin('kategoris', 'kategoris.id', '=', 'transaksis.kategori_id')
                ->orderBy('transaksis.id', 'DESC');
        
        $query->when($request->search, function ($query) use ($request) {
            $query->where(function($queryx) use ($request) {
                    $queryx->where('transaksis.deskripsi', 'like', "%{$request->search}%");
            });
        });
        
        
        $model = $query->select('transaksis.*', 'kategoris.nama as kategori_nama', 'kategoris.tipe as kategori_tipe')
                ->paginate($page)
                ->appends(request()
                ->query());

        return view('transaksi.index',compact('model'))->with([
            'search' => $search,
            'i' =>  (( (int) request()->input('page', 1) - 1) * $page)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Kategori::get();
        return view('transaksi.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_transaksi' => 'required|date|date_format:d-m-Y',
            'nominal' => 'required|numeric|max:999999999999999',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'required|max:255',
        ]);
        
        $model = new Transaksi;
        $model->nominal = $request->input('nominal');
        $model->kategori_id = $request->input('kategori_id');
        $model->deskripsi = $request->input('deskripsi');
        $model->tanggal_transaksi = date('Y-m-d', strtotime($request->input('tanggal_transaksi')));
        $model->save();
       
        return redirect()->route('transaksi')->with(['success' => "Berhasil menyimpan data"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = Transaksi::findOrFail($id);
        $category = Kategori::get();
        return view('transaksi.update',compact('id'))->with([
            'model' => $model,
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_transaksi' => 'required|date|date_format:d-m-Y',
            'nominal' => 'required|numeric|max:999999999999999',
            'kategori_id' => 'required|exists:kategoris,id',
            'deskripsi' => 'required|max:255',
        ]);
        
        $model = Transaksi::findOrFail($id);
        $model->nominal = $request->input('nominal');
        $model->kategori_id = $request->input('kategori_id');
        $model->deskripsi = $request->input('deskripsi');
        $model->tanggal_transaksi = date('Y-m-d', strtotime($request->input('tanggal_transaksi')));
        $model->save();
       
        return redirect()->route('transaksi')->with(['success' => "Berhasil memperbarui data"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Transaksi::findOrFail($id);
        if($model->delete()) {
            return redirect()->route('transaksi')->with(['success' => "Berhasil menghapus data"]);
        }
        
        return redirect()->route('transaksi')->with(['error' => "Gagal menghapus data"]);
    }
}
