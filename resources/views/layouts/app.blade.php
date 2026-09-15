<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'YLAKS') - Luxury Ladies Dresses & Haute Couture</title>
    <meta name="description" content="YLAKS Luxury Couture - Exclusive evening gowns, cocktail dresses, summer midis, and bespoke dress reservations.">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;0,700;0,800;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')
</head>
<body>

    <!-- Main Navigation Header -->
    <header class="navbar">
        <div class="container nav-container">
            <a href="{{ route('home') }}" class="brand-logo" style="display:flex; align-items:center; gap:12px;">
                <img src="{{ asset('images/logo.svg') }}" alt="YLAKS Logo" style="height:80px; max-width:220px; object-fit:contain;">
            </a>

            <nav>
                <ul class="nav-links">
                    <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('catalog.index') }}" class="nav-link {{ request()->routeIs('catalog.*') ? 'active' : '' }}">Dress Collection</a></li>
                    <li><a href="{{ route('basket.index') }}" class="nav-link {{ request()->routeIs('basket.*') ? 'active' : '' }}">Boutique Basket</a></li>
                </ul>
            </nav>

            <div style="display:flex; align-items:center; gap:16px;">
                @php
                    $basketCount = array_sum(array_column(session()->get('request_basket', []), 'quantity'));
                @endphp
                <a href="{{ route('basket.index') }}" class="cart-btn">
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                    <span>Dress Request</span>
                    <span class="badge-count">{{ $basketCount }}</span>
                </a>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">Boutique Admin</a>
                    @else
                        <span style="font-weight:600; font-size:0.9rem;">Hi, {{ auth()->user()->name }}</span>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="cart-btn">Sign Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="cart-btn"><span>Sign In / Register</span></a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Global Alert Notifications -->
    <div class="container" style="margin-top:20px;">
        @if(session('success'))
            <div class="alert alert-success">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"></path></svg>
                {{ session('error') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                {{ session('warning') }}
            </div>
        @endif
    </div>

    <!-- Main Content Body -->
    <main style="flex-grow:1;">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container footer-grid">
            <div>
                <div class="footer-brand" style="margin-bottom:14px;">
                    <img src="{{ asset('images/logo.svg') }}" alt="YLAKS Logo" style="height:80px; filter:brightness(0) invert(1);">
                </div>
                <p style="font-size:0.9rem; line-height:1.7; color:#a8a29e;">Exclusive haute couture ladies dresses, red carpet gala gowns, and bespoke silk midis. Select your favorite dresses and submit your request directly to our atelier stylists.</p>
            </div>
            <div>
                <h4 style="color:white; margin-bottom:16px; font-family:var(--font-heading);">Boutique</h4>
                <ul style="list-style:none; display:flex; flex-direction:column; gap:8px;">
                    <li><a href="{{ route('home') }}" style="color:#a8a29e;">Home</a></li>
                    <li><a href="{{ route('catalog.index') }}" style="color:#a8a29e;">Dress Collection</a></li>
                    <li><a href="{{ route('basket.index') }}" style="color:#a8a29e;">Request Basket</a></li>
                </ul>
            </div>
            <div>
                <h4 style="color:white; margin-bottom:16px; font-family:var(--font-heading);">Collections</h4>
                <ul style="list-style:none; display:flex; flex-direction:column; gap:8px;">
                    <li><a href="{{ route('catalog.index', ['category' => 'evening-gala-gowns']) }}" style="color:#a8a29e;">Evening Gowns</a></li>
                    <li><a href="{{ route('catalog.index', ['category' => 'cocktail-party-dresses']) }}" style="color:#a8a29e;">Cocktail & Party</a></li>
                    <li><a href="{{ route('catalog.index', ['category' => 'casual-summer-dresses']) }}" style="color:#a8a29e;">Summer Midis</a></li>
                </ul>
            </div>
            <div>
                <h4 style="color:white; margin-bottom:16px; font-family:var(--font-heading);">Stylist Inquiries</h4>
                <p style="font-size:0.875rem; color:#a8a29e;">Email: atelier@voguevelvet.com</p>
                <p style="font-size:0.875rem; color:#a8a29e;">Phone: +1 (800) 789-VELVET</p>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                &copy; {{ date('Y') }} YLAKS Luxury Couture. All rights reserved.
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
