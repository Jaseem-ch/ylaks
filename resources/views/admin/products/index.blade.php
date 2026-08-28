@extends('layouts.admin')

@section('title', 'Product Catalog Manager')
@section('header', 'Product Catalog Directory')

@section('content')
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px;">
    <p style="color:var(--text-muted);">Manage equipment items, pricing estimates, stock levels, and category assignments.</p>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
        + Add New Product
    </a>
</div>

<div class="table-card">
    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>SKU</th>
                <th>Category</th>
                <th>Est. Price</th>
                <th>Availability</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>
                        <div style="display:flex; align-items:center; gap:12px;">
                            @if($product->image)
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" style="width:40px; height:40px; object-fit:cover; border-radius:6px;">
                            @endif
                            <div>
                                <strong style="color:var(--secondary);">{{ $product->name }}</strong>
                                @if($product->is_featured)
                                    <span class="badge badge-primary" style="font-size:0.65rem; margin-left:4px;">Featured</span>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td style="font-family:monospace; font-weight:600;">{{ $product->sku }}</td>
                    <td>{{ $product->category ? $product->category->name : 'Uncategorized' }}</td>
                    <td style="font-weight:700; color:var(--primary);">${{ number_format($product->price, 2) }}</td>
                    <td><span class="badge badge-info">{{ $product->availability_status }}</span></td>
                    <td style="font-weight:600;">{{ $product->stock_quantity }}</td>
                    <td>
                        @if($product->is_active)
                            <span class="badge badge-success">Active</span>
                        @else
                            <span class="badge badge-secondary">Disabled</span>
                        @endif
                    </td>
                    <td>
                        <div style="display:flex; gap:6px;">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-secondary btn-sm">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" style="text-align:center; padding:30px; color:var(--text-muted);">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="padding:16px; display:flex; justify-content:center;">
        {{ $products->links() }}
    </div>
</div>
@endsection
