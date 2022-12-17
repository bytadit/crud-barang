@extends('layouts.main')
@section('container')

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">NAMA</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama', $barang->nama) }}" placeholder="Masukkan Nama barang">

                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label class="font-weight-bold">JUMLAH</label>
                                <input type="number" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah" required autofocus value="{{ old('jumlah'), $barang->jumlah }}" aria-describedby="basic-addon1" step="1">
                                @error('jumlah')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Category</label>
                                <select class="form-select" name="category_id" id="category_id" required>
                                    @foreach ($categories as $category)
                                        @if(old('category_id', $barang->category_id) == $category->id)
                                            <option value="{{ $category->id }}" selected>{{ $category->nama }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->nama }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>



                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
