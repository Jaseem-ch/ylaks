@extends('layouts.admin')

@section('title', 'Create New Product')
@section('header', 'Add Product to Catalog')

@section('content')
<div style="margin-bottom:20px;">
    <a href="{{ route('admin.products.index') }}" style="font-weight:600; font-size:0.9rem;">&larr; Back to Product List</a>
</div>

<div style="max-width:800px; background:white; border:1px solid var(--border); border-radius:var(--radius-md); padding:32px; box-shadow:var(--shadow-sm);">
    <form action="{{ route('admin.products.store') }}" method="POST">
        @csrf

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <div class="form-group">
                <label class="form-label">Product Name <span style="color:var(--danger);">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" required placeholder="e.g. UltraServer Pro 5000">
                @error('name') <span style="color:var(--danger); font-size:0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">SKU Code <span style="color:var(--danger);">*</span></label>
                <input type="text" name="sku" value="{{ old('sku') }}" class="form-control" required placeholder="e.g. IT-USR-5000">
                @error('sku') <span style="color:var(--danger); font-size:0.8rem;">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <div class="form-group">
                <label class="form-label">Category <span style="color:var(--danger);">*</span></label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span style="color:var(--danger); font-size:0.8rem;">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Est. Unit Price ($) <span style="color:var(--danger);">*</span></label>
                <input type="number" step="0.01" name="price" value="{{ old('price', '0.00') }}" class="form-control" required>
                @error('price') <span style="color:var(--danger); font-size:0.8rem;">{{ $message }}</span> @enderror
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <div class="form-group">
                <label class="form-label">Availability Status</label>
                <select name="availability_status" class="form-control">
                    <option value="In Stock">In Stock</option>
                    <option value="Available on Request">Available on Request</option>
                    <option value="Made to Order">Made to Order</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Initial Stock Quantity</label>
                <input type="number" name="stock_quantity" value="{{ old('stock_quantity', 50) }}" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Image URL</label>
            <input type="text" name="image" value="{{ old('image') }}" class="form-control" placeholder="https://images.unsplash.com/...">
        </div>

        <div class="form-group">
            <label class="form-label">Product Description <span style="color:var(--danger);">*</span></label>
            <textarea name="description" class="form-control" style="min-height:120px;" required placeholder="Detailed specifications and capabilities...">{{ old('description') }}</textarea>
            @error('description') <span style="color:var(--danger); font-size:0.8rem;">{{ $message }}</span> @enderror
        </div>

        <div style="display:flex; gap:24px; margin-bottom:24px;">
            <label style="display:flex; align-items:center; gap:8px; font-weight:600; cursor:pointer;">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                Mark as Featured Product
            </label>

            <label style="display:flex; align-items:center; gap:8px; font-weight:600; cursor:pointer;">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                Active in Storefront Catalog
            </label>
        </div>

        <button type="submit" class="btn btn-primary" style="padding:12px 28px;">Save Product</button>
    </form>
</div>
@endsection
