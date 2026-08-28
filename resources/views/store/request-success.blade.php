@extends('layouts.app')

@section('title', 'Dress Request Received - Vogue & Velvet')

@section('content')
<div class="container" style="padding:60px 0; max-width:800px;">
    <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-lg); padding:50px; text-align:center; box-shadow:var(--shadow-md);">
        <div style="width:80px; height:80px; background:var(--primary-light); color:var(--primary); border-radius:50%; display:inline-flex; align-items:center; justify-content:center; margin-bottom:24px;">
            <svg width="42" height="42" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 13l4 4L19 7"></path></svg>
        </div>

        <h1 style="font-size:2.4rem; font-weight:800; color:var(--secondary); font-family:var(--font-heading); margin-bottom:12px;">Dress Request Submitted!</h1>
        <p style="font-size:1.1rem; color:var(--text-muted); max-width:600px; margin:0 auto 28px; line-height:1.6;">
            Thank you, <strong>{{ $itemRequest->customer_name }}</strong>. Your dress inquiry has been sent directly to our atelier team.
        </p>

        <div style="background:#faf7f2; border:1px solid var(--border); border-radius:var(--radius-md); padding:24px; text-align:left; margin-bottom:36px;">
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:18px; border-bottom:1px solid var(--border); padding-bottom:14px;">
                <div>
                    <div style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase;">Request Reference Code</div>
                    <div style="font-size:1.25rem; font-weight:800; color:var(--primary); font-family:var(--font-heading);">{{ $itemRequest->reference_code }}</div>
                </div>
                <div>
                    <div style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase;">Date Received</div>
                    <div style="font-weight:600; color:var(--secondary);">{{ $itemRequest->created_at->format('M d, Y - h:i A') }}</div>
                </div>
            </div>

            <div style="margin-bottom:18px;">
                <div style="font-size:0.75rem; color:var(--text-muted); text-transform:uppercase; margin-bottom:6px;">Requested Dresses</div>
                @foreach($itemRequest->details as $detail)
                    <div style="display:flex; justify-content:space-between; font-size:0.95rem; margin-bottom:6px;">
                        <span>{{ $detail->quantity }} &times; {{ $detail->product_name }}</span>
                        <span style="font-weight:700; color:var(--secondary);">${{ number_format($detail->subtotal, 2) }}</span>
                    </div>
                @endforeach
            </div>

            <div style="border-top:1px solid var(--border); padding-top:14px; display:flex; justify-content:space-between; align-items:center;">
                <span style="font-weight:700; color:var(--secondary); font-family:var(--font-heading);">Estimated Value:</span>
                <span style="font-size:1.3rem; font-weight:800; color:var(--primary); font-family:var(--font-heading);">${{ number_format($itemRequest->total_estimated_value, 2) }}</span>
            </div>
        </div>

        <div style="display:flex; gap:16px; justify-content:center;">
            <a href="{{ route('catalog.index') }}" class="btn btn-primary">
                Return to Collection
            </a>
            <a href="{{ route('home') }}" class="btn btn-outline" style="color:var(--text-main); border-color:var(--border);">
                Go to Homepage
            </a>
        </div>
    </div>
</div>
@endsection
