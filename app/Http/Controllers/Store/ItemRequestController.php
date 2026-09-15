<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\ItemRequest;
use App\Models\ItemRequestDetail;
use App\Mail\CompanyItemRequestMail;
use App\Mail\CustomerConfirmationMail;
use App\Services\InstagramNotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ItemRequestController extends Controller
{
    public function create()
    {
        $basket = session()->get('request_basket', []);

        if (empty($basket)) {
            return redirect()->route('catalog.index')->with('warning', 'Your request basket is empty. Please select items first.');
        }

        $totalPrice = array_reduce($basket, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
        $totalEstimated = $totalPrice;

        $user = auth()->user();

        return view('store.request-form', compact('basket', 'totalEstimated', 'totalPrice', 'user'));
    }

    public function store(Request $request)
    {
        $basket = session()->get('request_basket', []);

        if (empty($basket)) {
            return redirect()->route('catalog.index')->with('error', 'Your request basket is empty.');
        }

        $validated = $request->validate([
            'customer_name' => 'required|string|max:191',
            'customer_email' => 'required|email|max:191',
            'customer_phone' => 'required|string|max:50',
            'instagram_handle' => 'nullable|string|max:191',
            'company_name' => 'nullable|string|max:191',
            'delivery_address' => 'required|string|max:1000',
            'notes' => 'nullable|string|max:2000',
        ]);

        $totalEstimated = 0;
        foreach ($basket as $item) {
            $totalEstimated += $item['price'] * $item['quantity'];
        }

        // Generate Reference Code
        $refCode = 'REQ-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        $itemRequest = ItemRequest::create([
            'reference_code' => $refCode,
            'user_id' => auth()->id(),
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'instagram_handle' => $validated['instagram_handle'] ?? null,
            'company_name' => $validated['company_name'] ?? null,
            'delivery_address' => $validated['delivery_address'],
            'notes' => $validated['notes'] ?? null,
            'total_estimated_value' => $totalEstimated,
            'status' => 'new',
            'email_sent_at' => now(),
        ]);

        foreach ($basket as $item) {
            ItemRequestDetail::create([
                'item_request_id' => $itemRequest->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['name'],
                'product_sku' => $item['sku'],
                'unit_price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        // 1. Send Email Notification to Company & Customer
        $companyEmail = config('mail.company_email', env('COMPANY_NOTIFICATION_EMAIL', 'atelier@voguevelvet.com'));
        try {
            Mail::to($companyEmail)->send(new CompanyItemRequestMail($itemRequest));
            Mail::to($itemRequest->customer_email)->send(new CustomerConfirmationMail($itemRequest));
        } catch (\Exception $e) {
            \Log::error('Item Request Email dispatch error: ' . $e->getMessage());
        }

        // 2. Dispatch Instagram DM Notification
        try {
            InstagramNotificationService::sendRequestNotification($itemRequest);
        } catch (\Exception $e) {
            \Log::error('Instagram DM dispatch error: ' . $e->getMessage());
        }

        // Clear request basket
        session()->forget('request_basket');

        return redirect()->route('request.success', $itemRequest->reference_code);
    }

    public function success($referenceCode)
    {
        $itemRequest = ItemRequest::where('reference_code', $referenceCode)
            ->with('details')
            ->firstOrFail();

        return view('store.request-success', compact('itemRequest'));
    }
}
