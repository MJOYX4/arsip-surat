@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Arsip Surat &raquo; Unggah</h2>
    <p class="mb-4">Silakan isi form berikut untuk mengunggah surat baru ke dalam arsip.</p>

    <form action="{{ route('archives.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="fw-bold">Nomor Surat</label>
            <input type="number" name="nomor_surat" class="form-control" value="{{ old('nomor_surat') }}" required>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Kategori</label>
            <select name="category_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $c)
                    <option value="{{ $c->id }}" @selected(old('category_id')==$c->id)>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label class="fw-bold">Upload File (PDF)</label>
            <input type="file" name="file" accept="application/pdf" class="form-control" required>
        </div>

        {{-- Tombol Aksi --}}
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('archives.index') }}" class="btn btn-secondary">&laquo; Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>
@endsection
