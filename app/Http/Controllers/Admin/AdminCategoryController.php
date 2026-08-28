<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:500',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->has('is_featured');

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:500',
            'is_featured' => 'nullable|boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->has('is_featured');

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
