@extends('layouts.admin')

@section('title', 'Item Requests Manager')
@section('header', 'Item Requests Directory')

@section('content')
<!-- Filter & Search Bar -->
<div style="background:white; border:1px solid var(--border); border-radius:var(--radius-md); padding:20px; margin-bottom:24px;">
    <form action="{{ route('admin.requests.index') }}" method="GET" style="display:flex; gap:16px; align-items:flex-end;">
        <div style="flex-grow:1;">
            <label class="form-label">Search Request</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search reference code, customer name, email, company..." class="form-control">
        </div>
        <div style="width:200px;">
            <label class="form-label">Filter Status</label>
            <select name="status" class="form-control">
                <option value="">All Statuses</option>
                <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>New</option>
                <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Under Review</option>
                <option value="quoted" {{ request('status') == 'quoted' ? 'selected' : '' }}>Quoted</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="height:42px;">Filter</button>
    </form>
</div>

<!-- Requests Table -->
<div class="table-card">
    <table class="table">
        <thead>
            <tr>
                <th>Ref Code</th>
                <th>Customer / Company</th>
                <th>Contact Details</th>
                <th>Est. Pipeline Value</th>
                <th>Status</th>
                <th>Submitted Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $req)
                <tr>
                    <td style="font-family:monospace; font-weight:700; color:var(--primary);">{{ $req->reference_code }}</td>
                    <td>
                        <strong style="color:var(--secondary);">{{ $req->customer_name }}</strong>
                        @if($req->company_name)
                            <div style="font-size:0.75rem; color:var(--text-muted);">{{ $req->company_name }}</div>
                        @endif
                    </td>
                    <td>
                        <div>{{ $req->customer_email }}</div>
                        <div style="font-size:0.75rem; color:var(--text-muted);">{{ $req->customer_phone }}</div>
                    </td>
                    <td style="font-weight:800; color:var(--secondary);">${{ number_format($req->total_estimated_value, 2) }}</td>
                    <td>
                        <span class="badge {{ $req->status_badge_class }}">{{ $req->status_formatted }}</span>
                    </td>
                    <td style="font-size:0.85rem; color:var(--text-muted);">{{ $req->created_at->format('M d, Y - H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.requests.show', $req->id) }}" class="btn btn-primary btn-sm">Inspect Request</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:30px; color:var(--text-muted);">No requests match the query.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="padding:16px; display:flex; justify-content:center;">
        {{ $requests->links() }}
    </div>
</div>
@endsection
