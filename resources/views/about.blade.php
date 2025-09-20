@extends('layouts.app')
@section('content')
<div class="container">
    <h2>About</h2>
<div class="d-flex justify-content-center mt-4">
  <div class="card shadow-lg border-0 rounded-4 p-4" style="max-width: 650px; width: 100%;">
    <div class="row g-4 align-items-center">
      <!-- Foto di kiri -->
      <div class="col-md-4 text-center">
        <img src="{{ asset('images/foto.jpg') }}" 
             alt="Foto" 
             class="rounded-rectangle img-fluid border border-3 border-primary shadow-sm" 
             style="width: 140px; height: 140px; object-fit: cover;">
      </div>

      <!-- Data identitas di kanan -->
      <div class="col-md-8 text-start">
        <h5 class="fw-bold mb-3 text-primary">Aplikasi ini dibuat oleh</h5>
        <ul class="list-unstyled fs-6">
          <li class="mb-2"><i class="bi bi-person-fill me-2 text-primary"></i> <strong>Nama</strong> : Maria Cicilia Joyape</li>
          <li class="mb-2"><i class="bi bi-mortarboard-fill me-2 text-success"></i> <strong>Prodi</strong> : D3-MI PSDKU Kediri</li>
          <li class="mb-2"><i class="bi bi-card-text me-2 text-warning"></i> <strong>NIM</strong> : 2331730120</li>
          <li><i class="bi bi-calendar-event-fill me-2 text-danger"></i> <strong>Tanggal</strong> : {{ date('d F Y') }}</li>
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection
