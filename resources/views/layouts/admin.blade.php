<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - Vogue & Velvet Atelier Admin</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="admin-layout">
        <!-- Sidebar Navigation -->
        <aside class="admin-sidebar">
            <div class="admin-brand">
                <a href="{{ route('admin.dashboard') }}" style="color:white; text-decoration:none; display:flex; align-items:center; gap:8px;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="color:var(--primary);"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.72-8.72 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    Vogue Admin
                </a>
            </div>

            <ul class="admin-menu">
                <li class="admin-menu-item">
                    <a href="{{ route('admin.dashboard') }}" class="admin-menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Dashboard
                    </a>
                </li>
                <li class="admin-menu-item">
                    <a href="{{ route('admin.requests.index') }}" class="admin-menu-link {{ request()->routeIs('admin.requests.*') ? 'active' : '' }}">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        Dress Requests
                    </a>
                </li>
                <li class="admin-menu-item">
                    <a href="{{ route('admin.products.index') }}" class="admin-menu-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        Dress Catalog
                    </a>
                </li>
                <li class="admin-menu-item">
                    <a href="{{ route('admin.categories.index') }}" class="admin-menu-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M7 7h.01M7 11h.01M7 15h.01M11 7h8M11 11h8M11 15h8"></path></svg>
                        Dress Categories
                    </a>
                </li>
            </ul>

            <div style="padding:24px; margin-top:auto; border-top:1px solid #292524;">
                <a href="{{ route('home') }}" class="btn btn-outline btn-sm" style="width:100%; text-align:center;">&larr; Back to Boutique</a>
            </div>
        </aside>

        <!-- Main Admin Workspace -->
        <main class="admin-main">
            <!-- Top Header -->
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:32px;">
                <div>
                    <h1 style="font-size:1.8rem; font-weight:700; color:var(--secondary); font-family:var(--font-heading);">@yield('header_title', 'Admin Dashboard')</h1>
                    <p style="color:var(--text-muted); font-size:0.9rem;">Manage ladies dress inquiries, catalog items, and dress categories.</p>
                </div>
                <div style="display:flex; align-items:center; gap:16px;">
                    <span style="font-weight:600; font-size:0.9rem;">{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-sm">Sign Out</button>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
