@extends('layouts.admin')

@section('title', 'Categories Manager')
@section('header', 'Category Management')

@section('content')
<div style="display:grid; grid-template-columns:1fr 340px; gap:32px;">
    <!-- Categories List Table -->
    <div class="table-card">
        <table class="table">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Slug</th>
                    <th>Products Count</th>
                    <th>Featured</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $cat)
                    <tr>
                        <td>
                            <strong style="color:var(--secondary);">{{ $cat->name }}</strong>
                            <div style="font-size:0.8rem; color:var(--text-muted);">{{ Str::limit($cat->description, 60) }}</div>
                        </td>
                        <td style="font-family:monospace;">{{ $cat->slug }}</td>
                        <td style="font-weight:700;">{{ $cat->products_count }} items</td>
                        <td>
                            @if($cat->is_featured)
                                <span class="badge badge-success">Featured</span>
                            @else
                                <span class="badge badge-secondary">Standard</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Delete category?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:30px; color:var(--text-muted);">No categories created yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Create Category Form -->
    <div style="background:white; border:1px solid var(--border); border-radius:var(--radius-md); padding:24px; box-shadow:var(--shadow-sm); height:fit-content;">
        <h3 style="font-size:1.1rem; font-weight:800; color:var(--secondary); margin-bottom:16px;">Add New Category</h3>

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Category Name <span style="color:var(--danger);">*</span></label>
                <input type="text" name="name" class="form-control" required placeholder="e.g. Robotics & Automation">
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" placeholder="Brief domain overview..."></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Image URL</label>
                <input type="text" name="image" class="form-control" placeholder="https://images.unsplash.com/...">
            </div>

            <div class="form-group">
                <label style="display:flex; align-items:center; gap:8px; font-weight:600; cursor:pointer;">
                    <input type="checkbox" name="is_featured" value="1" checked>
                    Feature on Homepage
                </label>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;">Create Category</button>
        </form>
    </div>
</div>
@endsection
