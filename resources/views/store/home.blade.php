@extends('layouts.app')

@section('title', 'Exclusive Ladies Dresses & Couture')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="container hero-grid">
        <div>
            <span class="badge badge-primary" style="margin-bottom:18px; font-size:0.85rem; background:rgba(225,29,72,0.25); color:#fecdd3; border:1px solid rgba(254,205,211,0.3); font-family:var(--font-body);">
                New Collection 2026
            </span>
            <h1 class="hero-title">Timeless Elegance. Crafted for Extraordinary Moments.</h1>
            <p class="hero-subtitle">Discover handcrafted evening gowns, luxury silk slip dresses, and bespoke midi silhouettes. Select your favorite dresses and send your inquiry straight to our head atelier.</p>
            <div class="hero-actions">
                <a href="{{ route('catalog.index') }}" class="btn btn-primary">
                    Explore Dress Collection
                    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
                <a href="{{ route('basket.index') }}" class="btn btn-outline">
                    View Dress Basket
                </a>
            </div>
        </div>
        <div style="text-align:center; position:relative;">
            <img src="https://images.unsplash.com/photo-1566174053879-31528523f8ae?w=800&auto=format&fit=crop" alt="Luxury Evening Gown" style="width:100%; max-width:440px; height:500px; object-fit:cover; border-radius:var(--radius-lg); box-shadow:var(--shadow-glow); border:2px solid rgba(255,255,255,0.2);">
        </div>
    </div>
</section>

<!-- Boutique Value Propositions -->
<section style="background:white; padding:48px 0; border-bottom:1px solid var(--border);">
    <div class="container" style="display:grid; grid-template-columns:repeat(auto-fit, minmax(240px, 1fr)); gap:32px;">
        <div style="display:flex; gap:16px; align-items:flex-start;">
            <div style="background:var(--primary-light); color:var(--primary); padding:14px; border-radius:50%;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            </div>
            <div>
                <h4 style="font-weight:700; color:var(--secondary); font-family:var(--font-heading); font-size:1.1rem;">Bespoke Sizing</h4>
                <p style="font-size:0.875rem; color:var(--text-muted);">Custom fitting & custom sizing requests handled directly by our stylists.</p>
            </div>
        </div>
        <div style="display:flex; gap:16px; align-items:flex-start;">
            <div style="background:var(--primary-light); color:var(--primary); padding:14px; border-radius:50%;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <h4 style="font-weight:700; color:var(--secondary); font-family:var(--font-heading); font-size:1.1rem;">Direct Email Consultation</h4>
                <p style="font-size:0.875rem; color:var(--text-muted);">Selected dress lists emailed instantly to our fashion atelier for availability.</p>
            </div>
        </div>
        <div style="display:flex; gap:16px; align-items:flex-start;">
            <div style="background:var(--primary-light); color:var(--primary); padding:14px; border-radius:50%;">
                <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.72-8.72 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            </div>
            <div>
                <h4 style="font-weight:700; color:var(--secondary); font-family:var(--font-heading); font-size:1.1rem;">Haute Couture Fabrics</h4>
                <p style="font-size:0.875rem; color:var(--text-muted);">100% Mulberry silk, French chiffon, and European velvet textiles.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Dress Categories -->
<section style="padding:70px 0;">
    <div class="container">
        <h2 class="section-title">Explore Collections</h2>
        <p class="section-desc">Find the perfect dress silhouette for your occasion.</p>

        <div class="grid-4">
            @foreach($featuredCategories as $category)
                <a href="{{ route('catalog.index', ['category' => $category->slug]) }}" style="text-decoration:none;">
                    <div class="product-card" style="height:100%;">
                        <div class="product-image-wrap" style="height:260px;">
                            <img src="{{ $category->image }}" alt="{{ $category->name }}" class="product-image">
                        </div>
                        <div class="product-body" style="padding:18px;">
                            <h3 style="font-size:1.2rem; font-weight:700; color:var(--secondary); margin-bottom:6px;">{{ $category->name }}</h3>
                            <p style="font-size:0.85rem; color:var(--text-muted); line-height:1.5;">{{ Str::limit($category->description, 75) }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Dresses Grid -->
<section style="padding:70px 0; background:white; border-top:1px solid var(--border);">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:36px;">
            <div>
                <h2 class="section-title">Curated Dress Highlights</h2>
                <p class="section-desc" style="margin-bottom:0;">Hand-picked gowns and cocktail dresses available for order reservations.</p>
            </div>
            <a href="{{ route('catalog.index') }}" class="btn btn-outline" style="color:var(--primary); border-color:var(--primary);">
                View Full Collection
            </a>
        </div>

        <div class="grid-3">
            @foreach($featuredProducts as $product)
                <div class="product-card">
                    <div class="product-image-wrap">
                        <a href="{{ route('catalog.show', $product->slug) }}">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">
                        </a>
                        <span class="category-chip">{{ $product->category ? $product->category->name : 'Couture' }}</span>
                    </div>
                    <div class="product-body">
                        <div class="product-sku">SKU: {{ $product->sku }}</div>
                        <h3 class="product-title">
                            <a href="{{ route('catalog.show', $product->slug) }}" style="color:inherit;">{{ $product->name }}</a>
                        </h3>
                        <p class="product-desc">{{ $product->description }}</p>
                        
                        <div class="product-footer">
                            <div>
                                <span class="product-price">${{ number_format($product->price, 2) }}</span>
                                <span class="price-sub">{{ $product->availability_status }}</span>
                            </div>
                            <form action="{{ route('basket.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    + Add to Request
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
