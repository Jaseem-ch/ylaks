@extends('layouts.app')

@section('title', 'Send Dress Request to Atelier')

@section('content')
<div class="container" style="padding:40px 0; max-width:960px;">
    <h1 style="font-size:2.2rem; font-weight:700; color:var(--secondary); font-family:var(--font-heading); margin-bottom:8px;">Send Dress Inquiry to Atelier</h1>
    <p style="color:var(--text-muted); margin-bottom:36px;">Provide your contact details, preferred dress sizes (XS, S, M, L, XL), or custom measurements. Our head stylist will verify availability and confirm your order reservation by email.</p>

    <div style="display:grid; grid-template-columns:1fr 340px; gap:36px;">
        <!-- Form Section -->
        <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-lg); padding:36px; box-shadow:var(--shadow-sm);">
            <form action="{{ route('request.submit') }}" method="POST">
                @csrf

                <h3 style="font-size:1.2rem; font-weight:700; color:var(--secondary); font-family:var(--font-heading); margin-bottom:20px; border-bottom:1px solid var(--border); padding-bottom:10px;">
                    1. Contact Information
                </h3>

                <div class="form-group">
                    <label class="form-label">Full Name *</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name ?? '') }}" required class="form-control" placeholder="e.g. Sophia Laurent">
                    @error('customer_name') <span style="color:var(--danger); font-size:0.8rem;">{{ $message }}</span> @enderror
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                    <div class="form-group">
                        <label class="form-label">Email Address *</label>
                        <input type="email" name="customer_email" value="{{ old('customer_email', auth()->user()->email ?? '') }}" required class="form-control" placeholder="sophia@example.com">
                        @error('customer_email') <span style="color:var(--danger); font-size:0.8rem;">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number *</label>
                        <input type="text" name="customer_phone" value="{{ old('customer_phone', auth()->user()->phone ?? '') }}" required class="form-control" placeholder="+1 (555) 000-0000">
                        @error('customer_phone') <span style="color:var(--danger); font-size:0.8rem;">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Boutique / Organization Name (Optional)</label>
                    <input type="text" name="company_name" value="{{ old('company_name', auth()->user()->company_name ?? '') }}" class="form-control" placeholder="e.g. Laurent Fashion Atelier">
                </div>

                <h3 style="font-size:1.2rem; font-weight:700; color:var(--secondary); font-family:var(--font-heading); margin-top:32px; margin-bottom:20px; border-bottom:1px solid var(--border); padding-bottom:10px;">
                    2. Delivery & Fitting Details
                </h3>

                <div class="form-group">
                    <label class="form-label">Delivery Address *</label>
                    <textarea name="delivery_address" required class="form-control" rows="3" placeholder="Street Address, Suite, City, State, Zip Code">{{ old('delivery_address', auth()->user()->address ?? '') }}</textarea>
                    @error('delivery_address') <span style="color:var(--danger); font-size:0.8rem;">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Stylist Notes & Size Preferences (Optional)</label>
                    <textarea name="notes" class="form-control" rows="4" placeholder="Specify preferred sizes (e.g. Size Small for Evening Gown, Size Medium for Slip Dress), fitting height, or event date deadlines...">{{ old('notes') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%; height:50px; font-size:1.1rem; margin-top:10px;">
                    Submit Dress Request &rarr;
                </button>
            </form>
        </div>

        <!-- Order Summary Sidebar -->
        <div>
            <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-lg); padding:28px; box-shadow:var(--shadow-sm); position:sticky; top:100px;">
                <h3 style="font-size:1.2rem; font-weight:700; color:var(--secondary); font-family:var(--font-heading); margin-bottom:18px; border-bottom:1px solid var(--border); padding-bottom:12px;">Requested Items</h3>

                <div style="display:flex; flex-direction:column; gap:16px; margin-bottom:24px; max-height:300px; overflow-y:auto; padding-right:6px;">
                    @foreach($basket as $item)
                        <div style="display:flex; gap:12px; align-items:center;">
                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" style="width:48px; height:60px; object-fit:cover; border-radius:var(--radius-sm); border:1px solid var(--border);">
                            <div style="flex-grow:1;">
                                <div style="font-size:0.9rem; font-weight:700; color:var(--secondary); line-height:1.2;">{{ $item['name'] }}</div>
                                <div style="font-size:0.75rem; color:var(--text-muted);">Qty: {{ $item['quantity'] }} &times; ${{ number_format($item['price'], 2) }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="border-top:1px solid var(--border); padding-top:16px; display:flex; justify-content:space-between; align-items:center;">
                    <span style="font-weight:700; color:var(--secondary); font-family:var(--font-heading);">Estimated Total:</span>
                    <span style="font-size:1.3rem; font-weight:800; color:var(--primary); font-family:var(--font-heading);">${{ number_format($totalPrice, 2) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
