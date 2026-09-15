<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_code',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'instagram_handle',
        'company_name',
        'delivery_address',
        'notes',
        'total_estimated_value',
        'status',
        'admin_notes',
        'email_sent_at',
        'instagram_sent_at',
    ];

    protected $casts = [
        'total_estimated_value' => 'decimal:2',
        'email_sent_at' => 'datetime',
        'instagram_sent_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function details()
    {
        return $this->hasMany(ItemRequestDetail::class);
    }

    public function getStatusBadgeClassAttribute()
    {
        return match ($this->status) {
            'new' => 'badge-info',
            'under_review' => 'badge-warning',
            'quoted' => 'badge-primary',
            'approved' => 'badge-success',
            'completed' => 'badge-secondary',
            'cancelled' => 'badge-danger',
            default => 'badge-neutral',
        };
    }

    public function getStatusFormattedAttribute()
    {
        return ucwords(str_replace('_', ' ', $this->status));
    }
}
