@extends('layouts.app')

@section('title', 'Ladies Dress Collection')

@section('content')
<div style="background:var(--secondary); color:white; padding:48px 0; margin-bottom:40px;">
    <div class="container">
        <h1 style="font-size:2.5rem; font-weight:700;">Ladies Dress Collection</h1>
        <p style="color:#d6d3d1; margin-top:8px; font-size:1.05rem;">Filter by dress style, search silk & satin gowns, and add dresses to your atelier request basket.</p>
    </div>
</div>

<div class="container" style="margin-bottom:60px;">
    <div style="display:grid; grid-template-columns:260px 1fr; gap:36px;">
        <!-- Filters Sidebar -->
        <aside>
            <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-md); padding:24px; position:sticky; top:100px; box-shadow:var(--shadow-sm);">
                <h3 style="font-size:1.2rem; font-weight:700; color:var(--secondary); margin-bottom:18px; font-family:var(--font-heading);">Filter Collection</h3>
                
                <form action="{{ route('catalog.index') }}" method="GET">
                    <!-- Search Input -->
                    <div class="form-group">
                        <label class="form-label">Search Dress</label>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Silk, Velvet, Gala, SKU..." class="form-control">
                    </div>

                    <!-- Category List -->
                    <div class="form-group">
                        <label class="form-label">Dress Category</label>
                        <div style="display:flex; flex-direction:column; gap:8px;">
                            <a href="{{ route('catalog.index', array_merge(request()->except('category', 'page'), [])) }}" 
                               style="padding:8px 12px; border-radius:20px; font-size:0.9rem; {{ !request('category') ? 'background:var(--primary-light); color:var(--primary); font-weight:700;' : 'color:var(--text-main);' }}">
                                All Dress Categories
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('catalog.index', array_merge(request()->except('page'), ['category' => $cat->slug])) }}" 
                                   style="display:flex; justify-content:space-between; align-items:center; padding:8px 12px; border-radius:20px; font-size:0.9rem; {{ request('category') == $cat->slug ? 'background:var(--primary-light); color:var(--primary); font-weight:700;' : 'color:var(--text-main);' }}">
                                    <span>{{ $cat->name }}</span>
                                    <span style="font-size:0.75rem; background:#f5f5f4; padding:2px 8px; border-radius:10px; color:var(--text-muted);">{{ $cat->products_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Availability Status -->
                    <div class="form-group">
                        <label class="form-label">Availability</label>
                        <select name="status" class="form-control">
                            <option value="">All Statuses</option>
                            <option value="In Stock" {{ request('status') == 'In Stock' ? 'selected' : '' }}>In Stock</option>
                            <option value="Available on Request" {{ request('status') == 'Available on Request' ? 'selected' : '' }}>Available on Request</option>
                        </select>
                    </div>

                    <!-- Sort -->
                    <div class="form-group">
                        <label class="form-label">Sort By</label>
                        <select name="sort" class="form-control">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest Collection</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width:100%;">
                        Apply Filters
                    </button>
                    
                    @if(request()->hasAny(['q', 'category', 'status', 'sort']))
                        <a href="{{ route('catalog.index') }}" class="btn btn-secondary btn-sm" style="width:100%; margin-top:10px; justify-content:center;">
                            Clear All Filters
                        </a>
                    @endif
                </form>
            </div>
        </aside>

        <!-- Product Grid -->
        <div>
            @if($activeCategory)
                <div style="background:white; border:1px solid var(--border); padding:24px; border-radius:var(--radius-md); margin-bottom:28px;">
                    <h2 style="font-size:1.5rem; font-weight:700; color:var(--secondary); font-family:var(--font-heading);">{{ $activeCategory->name }}</h2>
                    <p style="color:var(--text-muted); font-size:0.95rem; margin-top:4px;">{{ $activeCategory->description }}</p>
                </div>
            @endif

            @if($products->isEmpty())
                <div style="background:white; border:1px dashed var(--border); border-radius:var(--radius-md); padding:60px 20px; text-align:center;">
                    <svg width="48" height="48" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="color:var(--text-muted); margin-bottom:12px;">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <h3 style="font-size:1.25rem; font-weight:700; color:var(--secondary); font-family:var(--font-heading);">No Dresses Match Criteria</h3>
                    <p style="color:var(--text-muted); margin-top:4px;">Try searching another keyword or clearing filters.</p>
                    <a href="{{ route('catalog.index') }}" class="btn btn-outline" style="margin-top:18px; color:var(--primary); border-color:var(--primary);">
                        Reset Dress Collection
                    </a>
                </div>
            @else
                <div class="grid-3">
                    @foreach($products as $product)
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
                                
                                <div style="margin-top:auto; padding-top:14px; border-top:1px solid var(--border); display:flex; align-items:center; justify-content:space-between;">
                                    <div>
                                        <span class="product-price">${{ number_format($product->price, 2) }}</span>
                                        <span class="price-sub">{{ $product->availability_status }}</span>
                                    </div>
                                    <form action="{{ route('basket.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            + Request Dress
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination Links -->
                <div style="margin-top:44px; display:flex; justify-content:center;">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
