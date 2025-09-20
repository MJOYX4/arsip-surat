@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Arsip</h2>
    <p class="mb-4">Ubah data arsip surat dan ganti file PDF jika diperlukan.</p>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('info'))
        <div class="alert alert-info">{{ session('info') }}</div>
    @endif


    {{-- Form Edit Arsip --}}
    <form action="{{ route('archives.update', $archive->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nomor Surat</label>
            <input type="text" name="nomor_surat" class="form-control"
                value="{{ old('nomor_surat', $archive->nomor_surat) }}" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}"
                        @selected(old('category_id', $archive->category_id) == $c->id)>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="title" class="form-control"
                value="{{ old('title', $archive->title) }}" required>
        </div>

        <div class="mb-3">
            <label>Ganti File (PDF)</label>
            <input type="file" name="file" class="form-control" accept="application/pdf">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti file.</small>
        </div>

        <a href="{{ route('archives.show', $archive->id) }}" class="btn btn-secondary">&laquo; Batal</a>
        <button class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
