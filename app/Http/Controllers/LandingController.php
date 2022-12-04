<?php

namespace App\Http\Controllers;

use App\Models\Baca;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan buku pada halaman beranda
        $buku = Buku::all();
        $baca = Baca::get()->first();
        return view('landing', compact('buku','baca'));
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
        //memberikan filter pada halaman beranda
        $kategori = $request->kategori;
        $status = $request->status;
        $hasil = new Terbaca($kategori, $status);
        $data = [
            'kategori' => $hasil->sortCategory(),
            'status' => $hasil->sortRead(),
        ];
        $buku = Buku::all()->where('kategori_id', $hasil->sortCategory());
        $baca = Baca::all();

        return view('landing', compact('data','buku','baca'));

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
        $buku = Buku::find($id);
        Baca::create([
            'user_id'=>Auth::user()->id,
            'buku_id'=>$buku->id,
        ]);
        return view('baca', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

class Category
{
    public function __construct($kategori, $status) {
        $this->kategori = $kategori;
        $this->status = $status;
    }

    public function sortCategory()
    {
        if ($this->kategori == "Romance" || $this->kategori == "romance") {
            return "1";
        } else if ($this->kategori == "Horror" || $this->kategori == "horror") {
            return "2";
        }else if ($this->kategori == "Misteri" || $this->kategori == "misteri") {
            return "3";
        }
        
    }
}

class Terbaca extends Category
{
    public function sortRead()
    {
        if ( $this->status == "sudah") {
            return "terbaca";
        } else {
            return "belum";
        }
        
    }
}

