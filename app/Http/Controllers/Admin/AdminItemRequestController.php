<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ItemRequest;
use Illuminate\Http\Request;

class AdminItemRequestController extends Controller
{
    public function index(Request $request)
    {
        $query = ItemRequest::with('details')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('reference_code', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('company_name', 'like', "%{$search}%");
            });
        }

        $requests = $query->paginate(15)->withQueryString();

        return view('admin.requests.index', compact('requests'));
    }

    public function show($id)
    {
        $itemRequest = ItemRequest::with(['details.product', 'user'])->findOrFail($id);
        return view('admin.requests.show', compact('itemRequest'));
    }

    public function updateStatus(Request $request, $id)
    {
        $itemRequest = ItemRequest::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:new,under_review,quoted,approved,completed,cancelled',
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        $itemRequest->update([
            'status' => $validated['status'],
            'admin_notes' => $validated['admin_notes'],
        ]);

        return redirect()->back()->with('success', "Request {$itemRequest->reference_code} status updated to " . ucwords(str_replace('_', ' ', $validated['status'])));
    }
}
