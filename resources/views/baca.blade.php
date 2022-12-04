@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Baca Buku</div>

                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' . $buku->cover) }}" alt="" width="200px">
                        <h4><strong>{{ $buku->judul }}</strong></h4>
                        <p>ditulis oleh : {{ $buku->penulis }}</p>
                        <p class="mt-5">{{ $buku->isi }}</p>
                    </div>
                    <form action="{{ url('buku/'. $buku->id) }}" method="POST">
                    @csrf
                    @method('put')

                    <input type="hidden" name="total_pembaca" value="1">
                    <button type="submit" class="btn btn-danger"> Selesai membaca</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection