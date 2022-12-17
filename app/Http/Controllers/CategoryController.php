<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Barang;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.index', [
            "categories" => Category::all()
        ]);
    }

    public function create()
    {
        return view('category.create', [
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'     => 'required',
        ]);

        $category = Category::create([
            'nama'     => $request->nama,
        ]);

        if($category){
            //redirect dengan pesan sukses
            return redirect()->route('category.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('category.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function show($id)
    {

    }

    public function edit(Category $category)
    {
        return view('category.edit', [
            'category' => $category,
            'categories' => Category::all()
        ]);
    }
    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'nama'     => 'required',
        ]);

        $category = Category::findOrFail($category->id);

        $category->update([
            'nama'     => $request->nama,
        ]);

        if($category){
            //redirect dengan pesan sukses
            return redirect()->route('category.index')->with(['success' => 'Data Berhasil Diupdate!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('category.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        $barang = Barang::where('category_id', '=', $category->id);
        $barang->delete();

        if($category){
            //redirect dengan pesan sukses
            return redirect()->route('category.index')->with(['success' => 'Data Berhasil Dihapus!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('category.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
