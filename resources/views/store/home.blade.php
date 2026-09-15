@extends('layouts.app')

@section('title', 'Exclusive Ladies Dresses & Couture')

@section('content')
<!-- Boutique Hero Banner Section with Background Image & Prominent Logo Card -->
<section class="hero">
    <div class="container hero-grid">
        <div>
            
            <h1 class="hero-title">Timeless Elegance. Crafted for Extraordinary Moments.</h1>
            <p class="hero-subtitle">Discover handcrafted kurta sets and co-ord sets . Select your favorite dresses and send your inquiry straight to our head atelier stylists.</p>
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

        <!-- Prominent Logo Card in Front of Background Banner -->
        <div style="text-align:center;">
            <div class="hero-logo-card">
                <div style="font-size:0.75rem; text-transform:uppercase; letter-spacing:2px; color:rgba(255,255,255,0.7); margin-bottom:12px; font-weight:600;">
                    Official Atelier Brand
                </div>
                <img src="{{ asset('images/logo.svg') }}" alt="Vogue & Velvet Brand Logo" class="hero-logo-img">
                <div style="margin-top:20px; font-size:0.875rem; color:#e7e5e4; font-weight:300; line-height:1.5;">
                    Luxury Couture &bull; Custom Fit Reservations &bull; Express Stylist Dispatch
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Featured Dresses Grid -->
<section style="padding:70px 0; background:white; border-top:1px solid var(--border);">
    <div class="container">
        <div style="display:flex; justify-content:space-between; align-items:flex-end; margin-bottom:36px;">
            <div>
                <h2 class="section-title">Curated Dress Highlights</h2>
                <p class="section-desc" style="margin-bottom:0;">Hand-picked kurta sets and co-ord sets available for order reservations.</p>
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
