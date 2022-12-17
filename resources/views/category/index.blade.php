@extends('layouts.main')
@section('container')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('category.create') }}" class="btn btn-md btn-success mb-3">TAMBAH category</a>
                        <div>
                            <form action="/logout" method="post">
                              @csrf
                                <button type="submit" class="btn btn-md btn-danger mb-3">Logout</button>
                            </form>
                          </div>
                          <a href="{{ route('barang.index') }}" class="btn btn-md btn-success mb-3">LIHAT BARANG</a>

                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">Nama category</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($categories as $category)
                                <tr>
                                    <td>{{ $category->nama }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('category.destroy', $category->id) }}" method="POST">
                                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data category belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


