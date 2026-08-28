@extends('layouts.app')

@section('title', $product->name . ' - Vogue & Velvet')

@section('content')
<div class="container" style="padding:40px 0;">
    <div style="font-size:0.875rem; color:var(--text-muted); margin-bottom:24px;">
        <a href="{{ route('home') }}">Home</a> &gt; 
        <a href="{{ route('catalog.index') }}">Dress Collection</a> &gt; 
        <a href="{{ route('catalog.index', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a> &gt; 
        <span style="color:var(--text-main);">{{ $product->name }}</span>
    </div>

    <div style="display:grid; grid-template-columns:1fr 1fr; gap:48px; background:white; border:1px solid var(--border); border-radius:var(--radius-lg); padding:40px; box-shadow:var(--shadow-sm);">
        <!-- Dress Image Section -->
        <div>
            <div style="width:100%; height:520px; background:#f5f5f4; border-radius:var(--radius-md); overflow:hidden; border:1px solid var(--border);">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" style="width:100%; height:100%; object-fit:cover; object-position:top center;">
            </div>
        </div>

        <!-- Dress Details & Atelier Form -->
        <div>
            <div style="font-size:0.8rem; font-weight:700; color:var(--primary); text-transform:uppercase; letter-spacing:1.5px; margin-bottom:6px;">SKU: {{ $product->sku }}</div>
            <h1 style="font-size:2.2rem; font-weight:700; color:var(--secondary); line-height:1.2; margin-bottom:14px; font-family:var(--font-heading);">{{ $product->name }}</h1>
            
            <div style="display:flex; align-items:center; gap:18px; margin-bottom:24px;">
                <span style="font-size:2.2rem; font-weight:800; color:var(--primary); font-family:var(--font-heading);">${{ number_format($product->price, 2) }}</span>
                <span class="badge badge-success" style="font-size:0.8rem;">{{ $product->availability_status }}</span>
            </div>

            <p style="color:var(--text-main); line-height:1.8; margin-bottom:30px; font-size:1.05rem; font-weight:300;">
                {{ $product->description }}
            </p>

            <!-- Garment Specifications Table -->
            @if(!empty($product->specifications))
                <div style="margin-bottom:30px;">
                    <h3 style="font-size:1.1rem; font-weight:700; color:var(--secondary); margin-bottom:14px; font-family:var(--font-heading);">Garment Specifications</h3>
                    <table style="width:100%; border-collapse:collapse; background:#faf7f2; border-radius:var(--radius-sm); overflow:hidden;">
                        @foreach($product->specifications as $key => $val)
                            <tr>
                                <td style="padding:12px 18px; font-weight:600; font-size:0.875rem; width:40%; border-bottom:1px solid var(--border); color:var(--text-muted);">{{ $key }}</td>
                                <td style="padding:12px 18px; font-size:0.875rem; border-bottom:1px solid var(--border); color:var(--secondary); font-weight:500;">{{ $val }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif

            <!-- Request Action Form -->
            <form action="{{ route('basket.add') }}" method="POST" style="background:#faf7f2; border:1px solid var(--border); padding:28px; border-radius:var(--radius-md);">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                
                <div style="display:flex; gap:18px; align-items:flex-end;">
                    <div style="width:130px;">
                        <label class="form-label" style="margin-bottom:8px;">Quantity</label>
                        <input type="number" name="quantity" value="1" min="1" max="99" class="form-control" style="font-weight:700; text-align:center;">
                    </div>
                    <div style="flex-grow:1;">
                        <button type="submit" class="btn btn-primary" style="width:100%; height:48px; font-size:1.05rem;">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Add to Dress Request Basket
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Related Dresses -->
    @if($relatedProducts->count() > 0)
        <div style="margin-top:70px;">
            <h2 class="section-title">Similar Styles</h2>
            <p class="section-desc">More dresses from {{ $product->category->name }}</p>

            <div class="grid-3">
                @foreach($relatedProducts as $rel)
                    <div class="product-card">
                        <div class="product-image-wrap" style="height:300px;">
                            <a href="{{ route('catalog.show', $rel->slug) }}">
                                <img src="{{ $rel->image }}" alt="{{ $rel->name }}" class="product-image">
                            </a>
                        </div>
                        <div class="product-body">
                            <div class="product-sku">SKU: {{ $rel->sku }}</div>
                            <h3 class="product-title">
                                <a href="{{ route('catalog.show', $rel->slug) }}" style="color:inherit;">{{ $rel->name }}</a>
                            </h3>
                            <div class="product-footer">
                                <span class="product-price">${{ number_format($rel->price, 2) }}</span>
                                <a href="{{ route('catalog.show', $rel->slug) }}" class="btn btn-outline btn-sm" style="color:var(--primary); border-color:var(--primary);">View Dress</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
