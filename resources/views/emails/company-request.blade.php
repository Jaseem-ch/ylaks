<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Dress Inquiry Received</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #faf7f2; color: #292524; margin: 0; padding: 20px; }
        .email-card { max-width: 600px; margin: 0 auto; background: #ffffff; border: 1px solid #e7e5e4; border-radius: 12px; padding: 32px; }
        .header { text-align: center; border-bottom: 2px solid #e11d48; padding-bottom: 20px; margin-bottom: 24px; }
        .brand { font-size: 24px; font-weight: bold; color: #1c1917; font-family: Georgia, serif; }
        .ref-badge { background: #fff1f2; color: #be123c; font-size: 13px; font-weight: bold; padding: 4px 12px; border-radius: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 16px; margin-bottom: 24px; }
        .table th { background: #faf7f2; text-align: left; padding: 10px; font-size: 12px; color: #78716c; text-transform: uppercase; border-bottom: 1px solid #e7e5e4; }
        .table td { padding: 12px 10px; border-bottom: 1px solid #e7e5e4; font-size: 14px; }
        .total-row { font-weight: bold; font-size: 16px; color: #e11d48; }
        .footer { text-align: center; font-size: 12px; color: #78716c; margin-top: 32px; border-top: 1px solid #e7e5e4; padding-top: 16px; }
    </style>
</head>
<body>
    <div class="email-card">
        <div class="header">
            <div class="brand">Vogue & Velvet Atelier</div>
            <p style="margin: 6px 0 0; color: #78716c; font-size: 14px;">New Ladies Dress Request Notification</p>
        </div>

        <p>A new dress reservation request has been submitted by a client:</p>

        <div style="background: #faf7f2; padding: 16px; border-radius: 8px; margin-bottom: 24px;">
            <p style="margin: 0 0 8px;"><strong>Reference Code:</strong> <span class="ref-badge">{{ $itemRequest->reference_code }}</span></p>
            <p style="margin: 0 0 8px;"><strong>Customer Name:</strong> {{ $itemRequest->customer_name }}</p>
            <p style="margin: 0 0 8px;"><strong>Email:</strong> {{ $itemRequest->customer_email }}</p>
            <p style="margin: 0 0 8px;"><strong>Phone:</strong> {{ $itemRequest->customer_phone }}</p>
            @if($itemRequest->instagram_handle)
                <p style="margin: 0 0 8px;"><strong>Instagram Handle:</strong> <span style="color: #e11d48; font-weight: bold;">{{ '@' . ltrim($itemRequest->instagram_handle, '@') }}</span></p>
            @endif
            @if($itemRequest->company_name)
                <p style="margin: 0 0 8px;"><strong>Boutique/Org:</strong> {{ $itemRequest->company_name }}</p>
            @endif
            <p style="margin: 0 0 8px;"><strong>Delivery Address:</strong> {{ $itemRequest->delivery_address }}</p>
            @if($itemRequest->notes)
                <p style="margin: 0;"><strong>Stylist Notes/Size Info:</strong> {{ $itemRequest->notes }}</p>
            @endif
        </div>

        <h3 style="font-size: 16px; color: #1c1917; margin-bottom: 8px; font-family: Georgia, serif;">Requested Dresses</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Dress Name</th>
                    <th>SKU</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($itemRequest->details as $detail)
                    <tr>
                        <td><strong>{{ $detail->product_name }}</strong></td>
                        <td>{{ $detail->product_sku }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>${{ number_format($detail->subtotal, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="text-align: right; padding-top: 14px;"><strong>Total Value:</strong></td>
                    <td class="total-row" style="padding-top: 14px;">${{ number_format($itemRequest->total_estimated_value, 2) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            Vogue & Velvet Luxury Couture &bull; Atelier Notification System
        </div>
    </div>
</body>
</html>
