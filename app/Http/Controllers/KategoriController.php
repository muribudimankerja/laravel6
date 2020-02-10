<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;

class KategoriController extends Controller
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
         
        $query = Kategori::orderBy('kategoris.id', 'DESC');
        
        $query->when($request->search, function ($query) use ($request) {
            $query->where(function($queryx) use ($request) {
                    $queryx->where('kategoris.nama', 'like', "%{$request->search}%")
                            ->orwhere('kategoris.tipe', 'like', "%{$request->search}%")
                            ->orwhere('kategoris.deskripsi', 'like', "%{$request->search}%");
            });
        });
        
        
        $model = $query->paginate($page)->appends(request()->query());

        return view('kategori.index',compact('model'))->with([
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
        return view('kategori.create');
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
            'nama' => 'required|max:100',
            'tipe' => 'required|in:pemasukan,pengeluaran',
            'deskripsi' => 'required|max:255',
        ]);
        
        $model = new Kategori;
        $model->nama = $request->input('nama');
        $model->tipe = $request->input('tipe');
        $model->deskripsi = $request->input('deskripsi');
        $model->save();
       
        return redirect()->route('kategori')->with(['success' => "Berhasil menyimpan data"]);
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
        $model = Kategori::findOrFail($id);
        return view('kategori.update',compact('id'))->with([
            'model' => $model,
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
            'nama' => 'required|max:100',
            'tipe' => 'required|in:pemasukan,pengeluaran',
            'deskripsi' => 'required|max:255',
        ]);
        
        $model = Kategori::findOrFail($id);
        $model->nama = $request->input('nama');
        $model->tipe = $request->input('tipe');
        $model->deskripsi = $request->input('deskripsi');
        $model->save();
       
        return redirect()->route('kategori')->with(['success' => "Berhasil memperbarui data"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
