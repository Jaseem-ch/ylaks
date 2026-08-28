<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRequests = ItemRequest::count();
        $pendingRequests = ItemRequest::whereIn('status', ['new', 'under_review'])->count();
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalEstimatedPipeline = ItemRequest::where('status', '!=', 'cancelled')->sum('total_estimated_value');

        $recentRequests = ItemRequest::with('details')->latest()->take(6)->get();
        
        $topProducts = Product::withCount('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalRequests',
            'pendingRequests',
            'totalProducts',
            'totalCategories',
            'totalEstimatedPipeline',
            'recentRequests',
            'topProducts'
        ));
    }
}
