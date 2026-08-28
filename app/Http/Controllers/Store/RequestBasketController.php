<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class RequestBasketController extends Controller
{
    public function index()
    {
        $basket = session()->get('request_basket', []);
        $totalPrice = 0;
        $totalItems = 0;

        foreach ($basket as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
            $totalItems += $item['quantity'];
        }

        $totalEstimated = $totalPrice;

        return view('store.basket', compact('basket', 'totalPrice', 'totalItems', 'totalEstimated'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $basket = session()->get('request_basket', []);

        if (isset($basket[$product->id])) {
            $basket[$product->id]['quantity'] += $request->quantity;
        } else {
            $basket[$product->id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'sku' => $product->sku,
                'price' => (float) $product->price,
                'image' => $product->image,
                'quantity' => (int) $request->quantity,
                'category' => $product->category ? $product->category->name : 'General',
            ];
        }

        session()->put('request_basket', $basket);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => "'{$product->name}' added to your request basket!",
                'count' => array_sum(array_column($basket, 'quantity')),
            ]);
        }

        return redirect()->route('basket.index')->with('success', "'{$product->name}' added to your dress request list.");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $basket = session()->get('request_basket', []);

        if (isset($basket[$id])) {
            $basket[$id]['quantity'] = (int) $request->quantity;
            session()->put('request_basket', $basket);
        }

        return redirect()->route('basket.index')->with('success', 'Dress quantity updated.');
    }

    public function remove(Request $request, $id)
    {
        $basket = session()->get('request_basket', []);

        if (isset($basket[$id])) {
            unset($basket[$id]);
            session()->put('request_basket', $basket);
        }

        return redirect()->route('basket.index')->with('success', 'Dress removed from basket.');
    }

    public function clear()
    {
        session()->forget('request_basket');
        return redirect()->route('basket.index')->with('success', 'Dress request basket cleared.');
    }
}
