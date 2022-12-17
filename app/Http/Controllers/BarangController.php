<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\User;
use App\Models\Category;

class BarangController extends Controller
{
    public function index()
    {
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->nama;
        }
        return view('barang.index', [
            "barangs" => Barang::latest()->paginate(7)
        ]);
    }

    public function create()
    {
        return view('barang.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'     => 'required',
            'jumlah'   => 'required',
            'category_id' => 'required'
        ]);

        $barang = Barang::create([
            'nama'     => $request->nama,
            'jumlah'   => $request->jumlah,
            'category_id' => $request->category_id
        ]);

        if($barang){
            //redirect dengan pesan sukses
            return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('barang.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function show($id)
    {

    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', [
            'barang' => $barang,
            'categories' => Category::all()
        ]);
    }
    public function update(Request $request, Barang $barang)
    {
        $this->validate($request, [
            'nama'     => 'required',
            'jumlah'   => 'required',
            'category_id' => 'required'
        ]);

        $barang = Barang::findOrFail($barang->id);

        $barang->update([
            'nama'     => $request->nama,
            'jumlah'   => $request->jumlah,
            'category_id' => $request->category_id
        ]);

        if($barang){
            //redirect dengan pesan sukses
            return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('barang.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        if($barang){
            //redirect dengan pesan sukses
            return redirect()->route('barang.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('barang.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
