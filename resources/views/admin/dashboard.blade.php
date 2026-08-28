@extends('layouts.admin')

@section('title', 'Admin Overview')
@section('header', 'Procurement Dashboard')

@section('content')
<!-- KPI Cards Row -->
<div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:20px; margin-bottom:32px;">
    <div style="background:white; padding:24px; border-radius:var(--radius-md); border:1px solid var(--border); box-shadow:var(--shadow-sm);">
        <div style="font-size:0.8rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Total Inquiries</div>
        <div style="font-size:2rem; font-weight:800; color:var(--secondary); margin-top:4px;">{{ $totalRequests }}</div>
        <div style="font-size:0.8rem; color:var(--success); margin-top:4px; font-weight:600;">Lifetime requests</div>
    </div>

    <div style="background:white; padding:24px; border-radius:var(--radius-md); border:1px solid var(--border); box-shadow:var(--shadow-sm);">
        <div style="font-size:0.8rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Pending Review</div>
        <div style="font-size:2rem; font-weight:800; color:var(--warning); margin-top:4px;">{{ $pendingRequests }}</div>
        <div style="font-size:0.8rem; color:var(--warning); margin-top:4px; font-weight:600;">Requires sales response</div>
    </div>

    <div style="background:white; padding:24px; border-radius:var(--radius-md); border:1px solid var(--border); box-shadow:var(--shadow-sm);">
        <div style="font-size:0.8rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Active Catalog Items</div>
        <div style="font-size:2rem; font-weight:800; color:var(--primary); margin-top:4px;">{{ $totalProducts }}</div>
        <div style="font-size:0.8rem; color:var(--text-muted); margin-top:4px;">In {{ $totalCategories }} categories</div>
    </div>

    <div style="background:white; padding:24px; border-radius:var(--radius-md); border:1px solid var(--border); box-shadow:var(--shadow-sm);">
        <div style="font-size:0.8rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Pipeline Estimate</div>
        <div style="font-size:2rem; font-weight:800; color:var(--accent); margin-top:4px;">${{ number_format($totalEstimatedPipeline, 2) }}</div>
        <div style="font-size:0.8rem; color:var(--success); margin-top:4px; font-weight:600;">Active inquiry value</div>
    </div>
</div>

<!-- Recent Incoming Requests Table -->
<div class="table-card" style="margin-bottom:32px;">
    <div style="padding:20px; border-bottom:1px solid var(--border); display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h3 style="font-size:1.1rem; font-weight:800; color:var(--secondary);">Recent Incoming Item Requests</h3>
            <p style="font-size:0.85rem; color:var(--text-muted);">Real-time inquiries sent from customers to company email.</p>
        </div>
        <a href="{{ route('admin.requests.index') }}" class="btn btn-outline btn-sm" style="color:var(--primary); border-color:var(--primary);">
            View All Inquiries
        </a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Reference</th>
                <th>Customer / Company</th>
                <th>Contact</th>
                <th>Items Count</th>
                <th>Est. Total</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentRequests as $req)
                <tr>
                    <td style="font-family:monospace; font-weight:700; color:var(--primary);">{{ $req->reference_code }}</td>
                    <td>
                        <strong style="color:var(--secondary);">{{ $req->customer_name }}</strong>
                        @if($req->company_name)
                            <div style="font-size:0.75rem; color:var(--text-muted);">{{ $req->company_name }}</div>
                        @endif
                    </td>
                    <td>
                        <div style="font-size:0.85rem;">{{ $req->customer_email }}</div>
                        <div style="font-size:0.75rem; color:var(--text-muted);">{{ $req->customer_phone }}</div>
                    </td>
                    <td style="font-weight:700;">{{ $req->details->count() }} items</td>
                    <td style="font-weight:800; color:var(--secondary);">${{ number_format($req->total_estimated_value, 2) }}</td>
                    <td>
                        <span class="badge {{ $req->status_badge_class }}">{{ $req->status_formatted }}</span>
                    </td>
                    <td style="font-size:0.8rem; color:var(--text-muted);">{{ $req->created_at->diffForHumans() }}</td>
                    <td>
                        <a href="{{ route('admin.requests.show', $req->id) }}" class="btn btn-primary btn-sm">Inspect</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding:30px; color:var(--text-muted);">No item requests received yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
