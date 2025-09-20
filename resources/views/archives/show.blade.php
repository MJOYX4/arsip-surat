@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Lihat Arsip</h2>
    <p class="mb-4">Detail arsip surat yang tersimpan dalam sistem.</p>

    {{-- Detail Arsip --}}
    <table class="table table-bordered w-50">
        <tbody>
            <tr>
                <th style="width: 200px;">Nomor Surat</th>
                <td>{{ $archive->nomor_surat }}</td>
            </tr>
            <tr>
                <th>Judul</th>
                <td>{{ $archive->title }}</td>
            </tr>
            <tr>
                <th>Kategori</th>
                <td>{{ $archive->category->name }}</td>
            </tr>
            <tr>
    <th>Waktu</th>
    <td>
        @if($archive->created_at->eq($archive->updated_at))
            {{ $archive->created_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
        @else
            {{ $archive->updated_at->timezone('Asia/Jakarta')->format('d M Y H:i') }}
        @endif
    </td>
</tr>

        </tbody>
    </table>

    {{-- Preview PDF --}}
    <div class="border mt-4" style="height: 500px;">
        <object data="{{ asset('storage/' . $archive->file_path) }}" 
                type="application/pdf" 
                width="100%" 
                height="100%">
            <p>
                PDF tidak bisa ditampilkan. 
                <a href="{{ route('archives.download', $archive) }}">Download</a>
            </p>
        </object>
    </div>

    {{-- Tombol Aksi --}}
    <div class="mt-4">
        <a href="{{ route('archives.index') }}" class="btn btn-secondary">&laquo; Kembali</a>
        <a href="{{ route('archives.download', $archive) }}" class="btn btn-warning">Unduh</a>
        <a href="{{ route('archives.edit', $archive->id) }}" class="btn btn-primary">Edit/Ganti File</a>
    </div>
</div>
@endsection
