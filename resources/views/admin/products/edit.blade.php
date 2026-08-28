@extends('layouts.admin')

@section('title', 'Edit Product ' . $product->name)
@section('header', 'Edit Product Details')

@section('content')
<div style="margin-bottom:20px;">
    <a href="{{ route('admin.products.index') }}" style="font-weight:600; font-size:0.9rem;">&larr; Back to Product List</a>
</div>

<div style="max-width:800px; background:white; border:1px solid var(--border); border-radius:var(--radius-md); padding:32px; box-shadow:var(--shadow-sm);">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <div class="form-group">
                <label class="form-label">Product Name <span style="color:var(--danger);">*</span></label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label class="form-label">SKU Code <span style="color:var(--danger);">*</span></label>
                <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" class="form-control" required>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <div class="form-group">
                <label class="form-label">Category <span style="color:var(--danger);">*</span></label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Est. Unit Price ($) <span style="color:var(--danger);">*</span></label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="form-control" required>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <div class="form-group">
                <label class="form-label">Availability Status</label>
                <select name="availability_status" class="form-control">
                    <option value="In Stock" {{ old('availability_status', $product->availability_status) == 'In Stock' ? 'selected' : '' }}>In Stock</option>
                    <option value="Available on Request" {{ old('availability_status', $product->availability_status) == 'Available on Request' ? 'selected' : '' }}>Available on Request</option>
                    <option value="Made to Order" {{ old('availability_status', $product->availability_status) == 'Made to Order' ? 'selected' : '' }}>Made to Order</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Stock Quantity</label>
                <input type="number" name="stock_quantity" value="{{ old('stock_quantity', $product->stock_quantity) }}" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Image URL</label>
            <input type="text" name="image" value="{{ old('image', $product->image) }}" class="form-control">
        </div>

        <div class="form-group">
            <label class="form-label">Product Description <span style="color:var(--danger);">*</span></label>
            <textarea name="description" class="form-control" style="min-height:120px;" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div style="display:flex; gap:24px; margin-bottom:24px;">
            <label style="display:flex; align-items:center; gap:8px; font-weight:600; cursor:pointer;">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                Featured Product
            </label>

            <label style="display:flex; align-items:center; gap:8px; font-weight:600; cursor:pointer;">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                Active in Storefront
            </label>
        </div>

        <button type="submit" class="btn btn-primary" style="padding:12px 28px;">Update Product</button>
    </form>
</div>
@endsection
