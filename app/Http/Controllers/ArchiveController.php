<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $archives = Archive::with('category')
            ->when($q, fn($query) => $query->where('title','like',"%{$q}%"))
            ->orderBy('created_at','desc')
            ->paginate(10)
            ->withQueryString();

        $categories = Category::all();
        return view('archives.index', compact('archives','categories','q'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('archives.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_surat' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|mimes:pdf|max:10240',
        ]);

        $file = $request->file('file');
        $filename = time().'_'.preg_replace('/\s+/', '_', $file->getClientOriginalName());
        $path = $file->storeAs('archives', $filename, 'public');

        Archive::create([
            'nomor_surat' => $request->nomor_surat,
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $path,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('archives.index')->with('success','Data berhasil disimpan');
    }

    public function show(Archive $archive)
    {
        return view('archives.show', compact('archive'));
    }

    public function edit(Archive $archive)
    {
        $categories = Category::all();
        return view('archives.edit', compact('archive','categories'));
    }

public function update(Request $request, Archive $archive)
{
    $request->validate([
        'nomor_surat' => 'nullable|string|max:255',
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'file' => 'nullable|mimes:pdf|max:10240',
    ]);

    $data = $request->only(['nomor_surat','title','description','category_id']);

    // cek jika ada file baru
    if ($request->hasFile('file')) {
        Storage::disk('public')->delete($archive->file_path);
        $file = $request->file('file');
        $filename = time().'_'.preg_replace('/\s+/', '_', $file->getClientOriginalName());
        $data['file_path'] = $file->storeAs('archives', $filename, 'public');
    }

    // isi model dengan data baru
    $archive->fill($data);

    // cek apakah ada perubahan
    if ($archive->isDirty()) {
        $archive->save();
        return redirect()->route('archives.index')->with('success', 'Data berhasil diubah');
    }

    // kalau tidak ada perubahan, balik tanpa alert
    return redirect()->route('archives.index');
}


    public function destroy(Archive $archive)
    {
        Storage::disk('public')->delete($archive->file_path);
        $archive->delete();
        return redirect()->route('archives.index')->with('success','Data berhasil dihapus');
    }

    public function download(Archive $archive)
    {
        return Storage::disk('public')->download($archive->file_path, $archive->title . '.pdf');
    }
}
