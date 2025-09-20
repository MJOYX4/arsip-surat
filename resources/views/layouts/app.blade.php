<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Arsip Desa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
    }
    .layout {
      display: flex;
      min-height: 100vh;
    }
    .sidebar, .offcanvas-body {
      background-color: #f8f9fa;
    }
    .sidebar {
      border-right: 1px solid #dee2e6;
      width: 220px;
      padding: 20px 10px;
    }
    .sidebar a, .offcanvas-body a {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 10px;
      margin-bottom: 5px;
      border-radius: 6px;
      text-decoration: none;
      color: #333;
      transition: background-color 0.2s;
    }
    .sidebar a:hover, .offcanvas-body a:hover {
      background-color: #e9ecef;
    }
    .sidebar .active, .offcanvas-body .active {
      background-color: #0d6efd;
      color: white !important;
    }
    .content {
      flex-grow: 1;
      padding: 20px;
    }
  </style>
</head>
<body>
  <div class="layout">
    <!-- Sidebar Desktop -->
    <div id="sidebar" class="sidebar d-none d-md-block">
      <h5 class="mb-4">Menu</h5>
      <a href="{{ route('archives.index') }}" class="{{ request()->routeIs('archives.index') ? 'active' : '' }}">
        <i class="bi bi-archive"></i> <span>Arsip</span>
      </a>
      <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
        <i class="bi bi-folder"></i> <span>Kategori Surat</span>
      </a>
      <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">
        <i class="bi bi-info-circle"></i> <span>About</span>
      </a>
    </div>

    <!-- Content -->
    <div class="content" id="mainContent">
      <!-- Mobile menu button -->
      <div class="d-md-none mb-2">
        <button class="btn btn-primary" data-bs-toggle="offcanvas" data-bs-target="#mobileSidebar">
          ☰ Menu
        </button>
      </div>

      <h4 class="mb-3">Arsip Surat</h4>
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @yield('content')
    </div>
  </div>

  <!-- Offcanvas untuk mobile -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="mobileSidebar">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title">Menu</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
      <a href="{{ route('archives.index') }}" class="{{ request()->routeIs('archives.index') ? 'active' : '' }}">
        <i class="bi bi-archive"></i> <span>Arsip</span>
      </a>
      <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.index') ? 'active' : '' }}">
        <i class="bi bi-folder"></i> <span>Kategori Surat</span>
      </a>
      <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">
        <i class="bi bi-info-circle"></i> <span>About</span>
      </a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
