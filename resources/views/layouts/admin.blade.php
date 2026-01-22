<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --nav-h: 56px;
            --sb-w: 240px;
        }

        body {
            background: #f5f6f8;
        }

        /* Navbar di atas */
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }

        /* Sidebar TIDAK nabrak navbar */
        .sidebar {
            position: fixed;
            top: var(--nav-h);
            /* kunci: geser turun setinggi navbar */
            left: 0;
            width: var(--sb-w);
            height: calc(100vh - var(--nav-h));
            background: #343a40;
            color: #fff;
            overflow-y: auto;
        }

        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: .65rem 1rem;
        }

        .sidebar a:hover {
            background: #495057;
            color: #fff;
        }

        .sidebar .active {
            background: #0d6efd;
            color: #fff;
        }

        .sidebar .menu-label {
            text-transform: uppercase;
            font-size: .75rem;
            letter-spacing: .06em;
            color: #ced4da;
            padding: .75rem 1rem .25rem;
        }

        /* Area konten turun dan geser kanan */
        .content {
            margin-top: var(--nav-h);
            margin-left: var(--sb-w);
            padding: 24px;
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-dark bg-dark topbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Euphorbia LandScape Admin</a>
            <form action="{{ route('logout') }}" method="POST" class="mb-0">
                @csrf
                <button class="btn btn-outline-light btn-sm">Logout</button>
            </form>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="menu-label">Menu</div>

        <a href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            Dashboard
        </a>

        <a href="{{ route('admin.services.index') }}"
            class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
            Layanan
        </a>

        <a href="{{ route('admin.portfolios.index') }}"
            class="{{ request()->routeIs('admin.portfolios.*') ? 'active' : '' }}">
            Portofolio
        </a>

        <a href="{{ route('admin.projects.index') }}"
            class="{{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            Proyek
        </a>
        <a href="{{ route('admin.categories.index') }}"
            class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            Kategori Tanaman
        </a>

        <a href="{{ route('admin.plants.index') }}"
            class="{{ request()->routeIs('admin.plants.*') ? 'active' : '' }}">
            Tanaman
        </a>
        <a href="{{ route('admin.about.index') }}"
            class="{{ request()->routeIs('admin.about.*') ? 'active' : '' }}">
            About
        </a>
        <a href="{{ route('admin.contacts.index') }}"
            class="{{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
            Pesan Masuk
        </a>
    </aside>

    <!-- KONTEN -->
    <main class="content">
        @hasSection('title')
        <h1 class="mb-4">@yield('title')</h1>
        @endif

        @yield('content')
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>