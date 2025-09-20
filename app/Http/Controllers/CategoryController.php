<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Menampilkan semua kategori + pencarian
    public function index(Request $request)
    {
        $q = $request->input('q');

        $categories = Category::when($q, function ($query, $q) {
            return $query->where('name', 'like', "%{$q}%")
                         ->orWhere('description', 'like', "%{$q}%");
        })->paginate(10);

        return view('categories.index', compact('categories', 'q'));
    }

    // Menampilkan form tambah kategori
    public function create()
    {
        $nextId = Category::max('id') + 1;
        return view('categories.create', compact('nextId'));
    }

    // Menyimpan kategori baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string'
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Menampilkan form edit kategori
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Mengupdate kategori
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string'
        ]);

        // isi data baru
        $category->fill([
            'name' => $request->name,
            'description' => $request->description
        ]);

        // cek perubahan
        if ($category->isDirty()) {
            $category->save();
            return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui!');
        }

        // jika tidak ada perubahan
        return redirect()->route('categories.index');
    }

    // Menghapus kategori
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
}
