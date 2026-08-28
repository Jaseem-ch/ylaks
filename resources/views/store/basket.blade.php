@extends('layouts.app')

@section('title', 'Boutique Request Basket')

@section('content')
<div class="container" style="padding:40px 0;">
    <h1 style="font-size:2.2rem; font-weight:700; color:var(--secondary); font-family:var(--font-heading); margin-bottom:8px;">Boutique Request Basket</h1>
    <p style="color:var(--text-muted); margin-bottom:32px;">Review your selected dresses before submitting your inquiry to our head atelier stylists.</p>

    @if(empty($basket))
        <div style="background:white; border:1px dashed var(--border); border-radius:var(--radius-lg); padding:60px 20px; text-align:center;">
            <svg width="54" height="54" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" style="color:var(--primary); margin-bottom:16px;">
                <path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
            </svg>
            <h2 style="font-size:1.5rem; font-weight:700; color:var(--secondary); font-family:var(--font-heading);">Your Dress Basket is Empty</h2>
            <p style="color:var(--text-muted); margin-top:8px; margin-bottom:24px;">Browse our collection of evening gowns, cocktail dresses, and summer midis to start your request.</p>
            <a href="{{ route('catalog.index') }}" class="btn btn-primary">
                Explore Dress Collection
            </a>
        </div>
    @else
        <div style="display:grid; grid-template-columns:1fr 340px; gap:36px;">
            <!-- Selected Dresses Table -->
            <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-md); overflow:hidden; box-shadow:var(--shadow-sm);">
                <table style="width:100%; border-collapse:collapse; text-align:left;">
                    <thead style="background:#faf7f2; border-bottom:1px solid var(--border);">
                        <tr>
                            <th style="padding:16px 20px; font-size:0.8rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Dress</th>
                            <th style="padding:16px 20px; font-size:0.8rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Estimated Price</th>
                            <th style="padding:16px 20px; font-size:0.8rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Quantity</th>
                            <th style="padding:16px 20px; font-size:0.8rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Subtotal</th>
                            <th style="padding:16px 20px;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($basket as $id => $item)
                            <tr style="border-bottom:1px solid var(--border);">
                                <td style="padding:18px 20px; display:flex; align-items:center; gap:16px;">
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" style="width:64px; height:80px; object-fit:cover; border-radius:var(--radius-sm); border:1px solid var(--border);">
                                    <div>
                                        <div style="font-weight:700; color:var(--secondary); font-size:1.05rem;">{{ $item['name'] }}</div>
                                        <div style="font-size:0.75rem; color:var(--text-muted);">SKU: {{ $item['sku'] }}</div>
                                    </div>
                                </td>
                                <td style="padding:18px 20px; font-weight:600; color:var(--secondary);">${{ number_format($item['price'], 2) }}</td>
                                <td style="padding:18px 20px;">
                                    <form action="{{ route('basket.update', $id) }}" method="POST" style="display:flex; gap:8px;">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="99" class="form-control" style="width:70px; text-align:center; padding:6px 8px;">
                                        <button type="submit" class="btn btn-secondary btn-sm" style="padding:6px 12px;">Update</button>
                                    </form>
                                </td>
                                <td style="padding:18px 20px; font-weight:800; color:var(--primary); font-family:var(--font-heading);">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                                <td style="padding:18px 20px; text-align:right;">
                                    <form action="{{ route('basket.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background:none; border:none; color:var(--danger); cursor:pointer; padding:6px;" title="Remove Dress">
                                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="padding:20px; display:flex; justify-content:space-between; align-items:center; background:#faf7f2;">
                    <a href="{{ route('catalog.index') }}" class="btn btn-outline" style="color:var(--text-main); border-color:var(--border);">
                        &larr; Add More Dresses
                    </a>
                    <form action="{{ route('basket.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-secondary btn-sm" style="color:var(--danger);">Clear Entire Basket</button>
                    </form>
                </div>
            </div>

            <!-- Basket Summary Card -->
            <div>
                <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-md); padding:28px; box-shadow:var(--shadow-sm); position:sticky; top:100px;">
                    <h3 style="font-size:1.3rem; font-weight:700; color:var(--secondary); font-family:var(--font-heading); margin-bottom:18px; border-bottom:1px solid var(--border); padding-bottom:14px;">Summary</h3>
                    
                    <div style="display:flex; justify-content:space-between; margin-bottom:12px; font-size:0.95rem;">
                        <span style="color:var(--text-muted);">Total Selected Items:</span>
                        <span style="font-weight:700; color:var(--secondary);">{{ $totalItems }}</span>
                    </div>

                    <div style="display:flex; justify-content:space-between; margin-bottom:24px; font-size:1.25rem;">
                        <span style="font-weight:700; color:var(--secondary); font-family:var(--font-heading);">Estimated Total Value:</span>
                        <span style="font-weight:800; color:var(--primary); font-family:var(--font-heading);">${{ number_format($totalPrice, 2) }}</span>
                    </div>

                    <div style="background:var(--primary-light); border:1px solid rgba(225,29,72,0.2); padding:16px; border-radius:var(--radius-sm); margin-bottom:24px; font-size:0.85rem; color:#be123c; line-height:1.5;">
                        <strong>Boutique Note:</strong> Submitting this request sends your dress choices and sizing specifications directly to our stylists. No payment is charged now.
                    </div>

                    <a href="{{ route('request.form') }}" class="btn btn-primary" style="width:100%; height:48px; font-size:1.05rem;">
                        Send Inquiry to Atelier &rarr;
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
