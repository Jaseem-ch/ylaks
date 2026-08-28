@extends('layouts.admin')

@section('title', 'Inspect Request ' . $itemRequest->reference_code)
@section('header', 'Item Request Details')

@section('content')
<div style="margin-bottom:20px;">
    <a href="{{ route('admin.requests.index') }}" style="font-weight:600; font-size:0.9rem;">&larr; Back to Requests Directory</a>
</div>

<div style="display:grid; grid-template-columns:1fr 360px; gap:32px;">
    <!-- Main Details & Items -->
    <div>
        <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-md); padding:24px; margin-bottom:24px;">
            <div style="display:flex; justify-content:space-between; align-items:flex-start; margin-bottom:20px; border-bottom:1px solid var(--border); padding-bottom:16px;">
                <div>
                    <span style="font-size:0.8rem; text-transform:uppercase; color:var(--text-muted); font-weight:700;">Reference Code</span>
                    <h2 style="font-size:1.75rem; font-weight:800; color:var(--primary); font-family:monospace;">{{ $itemRequest->reference_code }}</h2>
                </div>
                <div>
                    <span class="badge {{ $itemRequest->status_badge_class }}" style="font-size:0.9rem; padding:6px 14px;">{{ $itemRequest->status_formatted }}</span>
                </div>
            </div>

            <!-- Customer Meta Grid -->
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px; background:#f8fafc; padding:20px; border-radius:var(--radius-sm);">
                <div>
                    <span style="font-size:0.75rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Customer Contact</span>
                    <div style="font-weight:700; font-size:1rem; color:var(--secondary); margin-top:2px;">{{ $itemRequest->customer_name }}</div>
                    <div style="font-size:0.85rem; color:var(--text-muted);"><a href="mailto:{{ $itemRequest->customer_email }}">{{ $itemRequest->customer_email }}</a></div>
                    <div style="font-size:0.85rem; color:var(--text-muted);">Phone: {{ $itemRequest->customer_phone }}</div>
                </div>

                <div>
                    <span style="font-size:0.75rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Company & Delivery</span>
                    <div style="font-weight:700; font-size:1rem; color:var(--secondary); margin-top:2px;">{{ $itemRequest->company_name ?? 'Individual Customer' }}</div>
                    <div style="font-size:0.85rem; color:var(--text-muted); margin-top:2px;">{{ $itemRequest->delivery_address ?? 'No address provided' }}</div>
                </div>
            </div>

            @if($itemRequest->notes)
                <div style="background:#fffbeb; border-left:4px solid var(--warning); padding:16px; border-radius:var(--radius-sm); margin-bottom:24px;">
                    <strong style="color:#92400e; font-size:0.9rem;">Customer Requirements & Special Notes:</strong>
                    <p style="margin-top:4px; font-size:0.9rem; color:#78350f; line-height:1.5;">{{ $itemRequest->notes }}</p>
                </div>
            @endif

            <!-- Item Breakdown Table -->
            <h3 style="font-size:1.1rem; font-weight:800; color:var(--secondary); margin-bottom:12px;">Requested Items List</h3>
            <table class="table" style="border:1px solid var(--border);">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>SKU</th>
                        <th>Est. Price</th>
                        <th>Qty</th>
                        <th style="text-align:right;">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($itemRequest->details as $item)
                        <tr>
                            <td>
                                <strong style="color:var(--secondary);">{{ $item->product_name }}</strong>
                            </td>
                            <td style="font-family:monospace;">{{ $item->product_sku }}</td>
                            <td>${{ number_format($item->unit_price, 2) }}</td>
                            <td style="font-weight:700;">{{ $item->quantity }}</td>
                            <td style="text-align:right; font-weight:800; color:var(--primary);">${{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div style="display:flex; justify-content:space-between; align-items:center; margin-top:20px; padding-top:16px; border-top:1px solid var(--border);">
                <span style="font-size:1.1rem; font-weight:700; color:var(--secondary);">Total Estimated Value:</span>
                <span style="font-size:1.75rem; font-weight:800; color:var(--primary);">${{ number_format($itemRequest->total_estimated_value, 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Status Manager & Internal Notes Panel -->
    <div>
        <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-md); padding:24px; box-shadow:var(--shadow-sm); position:sticky; top:90px;">
            <h3 style="font-size:1.1rem; font-weight:800; color:var(--secondary); margin-bottom:16px; border-bottom:1px solid var(--border); padding-bottom:10px;">Status & Team Actions</h3>

            <form action="{{ route('admin.requests.update-status', $itemRequest->id) }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="form-label">Inquiry Workflow Status</label>
                    <select name="status" class="form-control" style="font-weight:700;">
                        <option value="new" {{ $itemRequest->status == 'new' ? 'selected' : '' }}>New Request</option>
                        <option value="under_review" {{ $itemRequest->status == 'under_review' ? 'selected' : '' }}>Under Review</option>
                        <option value="quoted" {{ $itemRequest->status == 'quoted' ? 'selected' : '' }}>Quote Sent to Customer</option>
                        <option value="approved" {{ $itemRequest->status == 'approved' ? 'selected' : '' }}>Approved by Customer</option>
                        <option value="completed" {{ $itemRequest->status == 'completed' ? 'selected' : '' }}>Order Fulfilled / Completed</option>
                        <option value="cancelled" {{ $itemRequest->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">Internal Sales Notes / Follow-ups</label>
                    <textarea name="admin_notes" class="form-control" style="min-height:140px;" placeholder="Add internal team notes, quote numbers, or shipping tracking details...">{{ old('admin_notes', $itemRequest->admin_notes) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width:100%;">
                    Update Request Status
                </button>
            </form>

            <div style="border-top:1px solid var(--border); margin-top:20px; padding-top:16px; font-size:0.8rem; color:var(--text-muted);">
                <div>Email Dispatched: {{ $itemRequest->email_sent_at ? $itemRequest->email_sent_at->format('M d, Y H:i') : 'Pending' }}</div>
                <div style="margin-top:4px;">Request Received: {{ $itemRequest->created_at->format('M d, Y H:i') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
