@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">Daftar Buku</div>

                    <div class="card-body">
                        @if (Auth::user()->role == 'admin')
                            <div class="tambah">
                                <a href="" class="btn btn-success mb-3" data-bs-toggle="modal"
                                    data-bs-target="#tambah">Tambah</a>
                            </div>
                        @endif
                        <table class="table table-bordered p-3 text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID Buku</th>
                                    <th>Cover</th>
                                    <th>Judul</th>
                                    <th>Isi</th>
                                    <th>Penulis</th>
                                    <th>Total Pembaca</th>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>
                                    @if (Auth::user()->role == 'admin')
                                    <th>Status</th>
                                        <th>Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($buku as $key)
                                    <tr>
                                        <td>{{ $key->id }}</td>
                                        <td><img src="{{ asset('storage/' . $key->cover) }}" alt="" width="100px">
                                        </td>
                                        <td>{{ $key->judul }}</td>
                                        <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#isi{{ $key->id }}">
                                                Isi
                                            </button></td>
                                        <td>{{ $key->penulis }}</td>
                                        <td>{{ $key->total_pembaca }}</td>
                                        <td>{{ $key->tanggal }}</td>
                                        <td>{{ $key->kategori->nama }}</td>
                                        @if (Auth::user()->role == 'admin')
                                            <td>
                                                @if ($key->status_buku == 'aktif')
                                                    <p class="bg-success text-light rounded">{{ $key->status_buku }}</p>
                                                @else
                                                    <p class="bg-danger text-light rounded">{{ $key->status_buku }}</p>
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('buku.destroy', $key->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#ed{{ $key->id }}">Edit</a>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                    <div class="modal fade" id="isi{{ $key->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Isi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{ $key->isi }}
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="ed{{ $key->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Buku</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('buku.update', $key->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" name="judul" class="form-control"
                                                                value="{{ $key->judul }}" required>
                                                            <label for="formFloatingInput">Judul</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <textarea class="form-control" name="isi" id="floatingTextarea">{{ $key->isi }}</textarea>
                                                            <label for="floatingTextarea">Isi</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="text" name="penulis" class="form-control"
                                                                value="{{ $key->penulis }}" required>
                                                            <label for="formFloatingInput">Penulis</label>
                                                        </div>

                                                        <div class="mb-3 form-floating">
                                                            <img src="{{ asset('storage/' . $key->cover) }}" alt=""
                                                                width="100px">
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="file" name="cover" class="form-control">
                                                            <label for="formFloatingInput">Cover</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <input type="date" name="tanggal" class="form-control"
                                                                value="{{ $key->tanggal }}" required>
                                                            <label for="formFloatingInput">Tanggal</label>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <select class="form-select" id="floatingSelect"
                                                                name="status_buku"
                                                                aria-label="Floating label select example">
                                                                <option selected disabeled>{{ $key->status_buku }}</option>
                                                                <option value="aktif">Aktif</option>
                                                                <option value="tidak aktif">Tidak Aktif</option>
                                                            </select>
                                                        </div>
                                                        <div class="my-3 form-floating">
                                                            <select name="kategori_id" class="form-select">
                                                                <option selected>Pilih Kategori</option>
                                                                @foreach ($kategori as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $item->id == $key->kategori_id ? 'selected' : '' }}>
                                                                        {{ $item->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-warning">Edit</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Buku</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('buku.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 form-floating">
                        <input type="text" name="judul" class="form-control" required>
                        <label for="formFloatingInput">Judul</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <textarea class="form-control" name="isi" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Isi</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="text" name="penulis" class="form-control" required>
                        <label for="formFloatingInput">Penulis</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="file" name="cover" class="form-control" required>
                        <label for="formFloatingInput">Cover</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="date" name="tanggal" class="form-control" required>
                        <label for="formFloatingInput">Tanggal</label>
                    </div>
                    <div class="my-3 form-floating">
                        <select name="kategori_id" class="form-select">
                            <option selected>Pilih Kategori</option>
                            @foreach ($kategori as $item)
                                <option value="{{ $item->id }}" @selected(old('kategori_id') == $item->id)>{{ $item->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
            </form>
        </div>
    </div>
</div>
