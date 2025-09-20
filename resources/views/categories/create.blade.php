@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Kategori Surat &raquo; Tambah</h2>
    <p>Tambahkan atau edit data kategori. Jika sudah selesai, jangan lupa untuk mengklik tombol "Simpan"</p>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>ID (Auto Increment)</label>
            <input type="text" class="form-control" value="{{ $nextId ?? 'Auto' }}" readonly>
        </div>

        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="description" class="form-control" rows="3"></textarea>
        </div>

        <a href="{{ route('categories.index') }}" class="btn btn-secondary">&laquo; Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
