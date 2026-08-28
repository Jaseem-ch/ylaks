<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequestDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_request_id',
        'product_id',
        'product_name',
        'product_sku',
        'unit_price',
        'quantity',
        'subtotal',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function itemRequest()
    {
        return $this->belongsTo(ItemRequest::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
