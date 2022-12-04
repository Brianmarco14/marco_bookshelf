@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Daftar User</div>

                    <div class="card-body">
                        <div class="tambah">
                            <a href="" class="btn btn-success mb-3" data-bs-toggle="modal"
                                data-bs-target="#tambah">Tambah</a>
                        </div>
                        <table class="table table-bordered p-3 text-center align-middle">
                            <thead>
                                <tr>
                                    <th>ID user</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $key)
                                    <tr>
                                        <td>{{ $key->id }}</td>
                                        <td>{{ $key->name }}</td>
                                        <td>{{ $key->email }}</td>
                                        <td>{{ $key->role }}</td>
                                        <td>
                                        @if($key->status == "aktif")
                                            <p class="bg-success text-light rounded">{{ $key->status }}</p>
                                        @else
                                        <p class="bg-danger text-light rounded">{{ $key->status }}</p>

                                        @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('user.destroy', $key->id) }}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#ed{{ $key->id }}">Edit</a>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="ed{{ $key->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit User</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('user.update', $key->id) }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @method('put')
                                                        <div class="mb-3 form-floating">
                                                            <label for="formFloatingSelect">Status</label>
                                                            <select class="form-select" id="floatingSelect" name="status" aria-label="Floating label select example">
                                                                <option selected disabeled class="text-">{{ $key->status }}</option>
                                                                <option value="aktif">Aktif</option>
                                                                <option value="tidak aktif">Tidak Aktif</option>
                                                              </select>
                                                        </div>
                                                        <div class="mb-3 form-floating">
                                                            <label for="formFloatingSelect">Role</label>
                                                            <select class="form-select" id="floatingSelect" name="role" aria-label="Floating label select example">
                                                                <option selected disabeled class="text-">{{ $key->role }}</option>
                                                                <option value="user">User</option>
                                                                <option value="editor">Editor</option>
                                                                <option value="admin">Admin</option>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah user</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 form-floating">
                        <input type="text" name="name" class="form-control" required>
                        <label for="formFloatingInput">Nama</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="email" name="email" class="form-control" required>
                        <label for="formFloatingInput">Email</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="password" name="password" class="form-control" required>
                        <label for="formFloatingInput">Password</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <select class="form-select" id="floatingSelect" name="status" aria-label="Floating label select example">
                            <option selected disabeled>Pilih Status</option>
                            <option value="aktif">Aktif</option>
                            <option value="tidak aktif">Tidak Aktif</option>
                          </select>
                    </div>
                    <div class="mb-3 form-floating">
                        <select class="form-select" id="floatingSelect" name="role" aria-label="Floating label select example">
                            <option selected disabeled>Pilih Role</option>
                            <option value="user">User</option>
                            <option value="editor">Editor</option>
                            <option value="admin">Admin</option>
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
