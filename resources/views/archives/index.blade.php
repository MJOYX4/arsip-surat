@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Arsipkan Surat</h2>
    <p>Berikut ini surat-surat yang telah terbit dan diarsipkan. Klik "Lihat" pada kolom aksi untuk menampilkan surat.</p>

    {{-- Pencarian --}}
    <form method="GET" class="row g-2 mb-3 align-items-center">
        <div class="col-auto">
            <label for="search" class="col-form-label fw-bold">Cari judul:</label>
        </div>
        <div class="col-auto">
            <input id="search" name="q" value="{{ $q ?? '' }}" class="form-control" placeholder="Cari judul...">
        </div>
        <div class="col-auto">
            <button class="btn btn-dark">Cari</button>
        </div>
    </form>

    {{-- Tabel Arsip --}}
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-secondary">
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Waktu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($archives as $idx => $a)
            <tr>
                <td>{{ $archives->firstItem() + $idx }}</td>
                <td>{{ $a->nomor_surat }}</td>
                <td>{{ $a->title }}</td>
                <td>{{ $a->category->name }}</td>
                <td>
    @if($a->created_at->eq($a->updated_at))
        {{ $a->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
    @else
        {{ $a->updated_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
    @endif
</td>

                <td>
                    <a href="{{ route('archives.show',$a) }}" class="btn btn-sm btn-primary">Lihat</a>
                    <a href="{{ route('archives.download',$a) }}" class="btn btn-sm btn-warning">Unduh</a>

                    {{-- Tombol Hapus (trigger modal) --}}
                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteArchiveModal{{ $a->id }}">
                        Hapus
                    </button>

                    {{-- Modal Hapus --}}
                    <div class="modal fade" id="deleteArchiveModal{{ $a->id }}" tabindex="-1" aria-labelledby="deleteArchiveModalLabel{{ $a->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow-lg">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="deleteArchiveModalLabel{{ $a->id }}">Konfirmasi Hapus</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Apakah Anda yakin ingin menghapus arsip <strong>{{ $a->title }}</strong> dengan nomor surat <strong>{{ $a->nomor_surat }}</strong>?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('archives.destroy',$a) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
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
                <td colspan="6" class="text-center">Tidak ada data arsip</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination & Tombol Tambah --}}
    <div class="d-flex justify-content-between align-items-center mt-3">
        {{ $archives->links() }}
        <a href="{{ route('archives.create') }}" class="btn btn-success">[ + ] Arsipkan Surat</a>
    </div>
</div>
@endsection
