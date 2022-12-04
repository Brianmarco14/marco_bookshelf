@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">Daftar Buku</div>

                    <div class="card-body d-flex">
                        <div class="row">
                            <div class="col ">
                                <form action="{{ route('store') }}" method="POST">
                                    @csrf
                                    <input type="text" name="kategori" class="form-control"
                                        placeholder="Cari berdasarkan kategori..." required>
                                    <select class="form-select mt-1" id="floatingSelect" name="status"
                                        aria-label="Floating label select example">
                                        <option selected disabled>Pilih Status</option>
                                        <option value="sudah">Terbaca</option>
                                        <option value="belum">Belum Dibaca</option>
                                    </select>
                                    <button type="submit" class="btn btn-success mt-2">Cari</button>
                                </form>
                            </div>
                            @foreach ($buku as $key)
                                @if ($key->status_buku == 'aktif')
                                    @isset($data)
                                        @if ($key->kategori_id == $data['kategori'])
                                            <div class="col-3 mx-3">
                                                <div class="card" style="width: 12rem;">
                                                    <img src="{{ asset('storage/' . $key->cover) }}" class="card-img-top"
                                                        alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-text text-center"><strong>{{ $key->judul }}</strong>
                                                        </h5>
                                                        <p class="card-text text-center">Karya: {{ $key->penulis }}</p>
                                                        @foreach ($baca as $item)
                                                            @if (Auth::check() && Auth::user()->id != $item->user_id && $item->buku_id != $key->id)
                                                                <p class="bg-warning text-light rounded text-center">belum
                                                                    dibaca
                                                                </p>
                                                            @elseif(Auth::check() && Auth::user()->id == $item->user_id && $item->buku_id == $key->id)
                                                                <p class="bg-success text-light rounded text-center">sudah
                                                                    dibaca
                                                                </p>
                                                            @endif
                                                        @endforeach
                                                        @if (!Auth::check())
                                                            <div class="tombol text-center">
                                                                <button type="button" class="btn btn-secondary text-light">Anda
                                                                    belum
                                                                    login</button>
                                                            </div>
                                                        @else
                                                            <a href="{{ url('/baca/'. $key->id) }}" class="btn btn-primary">Baca</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endisset
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
