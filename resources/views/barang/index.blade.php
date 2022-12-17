@extends('layouts.main')
@section('container')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('barang.create') }}" class="btn btn-md btn-success mb-3">TAMBAH BARANG</a>
                        <div>
                            <form action="/logout" method="post">
                              @csrf
                                <button type="submit" class="btn btn-md btn-danger mb-3">Logout</button>
                            </form>
                        </div>
                        <a href="{{ route('category.index') }}" class="btn btn-md btn-success mb-3">LIHAT KATEGORI</a>

                        <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Jumlah Barang</th>
                                <th scope="col">Category</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($barangs as $barang)
                                <tr>
                                    <td>{{ $barang->nama }}</td>
                                    <td>{{ $barang->jumlah }}</td>
                                    <td>{{ $barang->category->nama }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barang.destroy', $barang->id) }}" method="POST">
                                            <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Barang belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>
                          {{ $barangs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


