@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Kategori Surat</h2>
    <p>Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat. Klik "Tambah" pada kolom aksi untuk menambahkan kategori baru.</p>

    {{-- Pencarian --}}
    <form method="GET" action="{{ route('categories.index') }}" class="row g-2 mb-3 align-items-center">
        <div class="col-auto">
            <label for="search" class="col-form-label fw-bold">Cari kategori:</label>
        </div>
        <div class="col-auto">
            <input id="search" name="q" value="{{ $q ?? '' }}" class="form-control" placeholder="Cari kategori...">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-dark">Cari</button>
        </div>
    </form>

    {{-- Tabel Kategori --}}
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-secondary">
            <tr>
                <th>ID Kategori</th>
                <th>Nama Kategori</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
                <td>

                    {{-- Tombol Hapus (trigger modal) --}}
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteModal{{ $category->id }}">
                        Hapus
                    </button>

                    {{-- Tombol Edit --}}
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>


                    {{-- Modal Hapus --}}
                    <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $category->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteModalLabel{{ $category->id }}">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus kategori <strong>{{ $category->name }}</strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada kategori</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination & Tombol Tambah --}}
    <div class="d-flex justify-content-between align-items-center mt-3">
        {{ $categories->appends(['q' => request('q')])->links() }}
        <a href="{{ route('categories.create') }}" class="btn btn-success">[ + ] Tambah Kategori Baru</a>
    </div>
</div>
@endsection
