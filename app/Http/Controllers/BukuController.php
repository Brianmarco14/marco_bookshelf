<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan buku pada halaman admin
        $buku = Buku::all();
        $kategori = Kategori::all();
        return view('buku', compact('buku','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //menambah buku
        $file = $request->file('cover')->store('cover');
        Buku::create([
            'judul'=>$request->judul,
            'isi'=>$request->isi,
            'penulis'=>$request->penulis,
            'tanggal'=>$request->tanggal,
            'kategori_id'=>$request->kategori_id,
            'cover'=>$file,
        ]);
        return redirect('buku');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku)
    {
        //mengubah buku
        $data = $request->all();
        try {
            $data['cover']=$request->file('cover')->store('cover');
            $buku->update($data);
        } catch (\Throwable $th) {
            $data['cover']=$buku->cover;
            $buku->update($data);

        }
        return redirect('buku');
    }
    public function tambah(Request $request, Buku $buku)
    {
        //mengubah buku
        $data = $request->all();
        try {
            $data['cover']=$request->file('cover')->store('cover');
            $buku->update($data);
        } catch (\Throwable $th) {
            $data['cover']=$buku->cover;
            $buku->update($data);

        }
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        //menghapus buku
        $buku->delete();
        return redirect('buku');

    }
}
