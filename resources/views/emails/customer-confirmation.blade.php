<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dress Request Confirmation</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #faf7f2; color: #292524; margin: 0; padding: 20px; }
        .email-card { max-width: 600px; margin: 0 auto; background: #ffffff; border: 1px solid #e7e5e4; border-radius: 12px; padding: 32px; }
        .header { text-align: center; border-bottom: 2px solid #e11d48; padding-bottom: 20px; margin-bottom: 24px; }
        .brand { font-size: 24px; font-weight: bold; color: #1c1917; font-family: Georgia, serif; }
        .ref-badge { background: #fff1f2; color: #be123c; font-size: 13px; font-weight: bold; padding: 4px 12px; border-radius: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 16px; margin-bottom: 24px; }
        .table th { background: #faf7f2; text-align: left; padding: 10px; font-size: 12px; color: #78716c; text-transform: uppercase; border-bottom: 1px solid #e7e5e4; }
        .table td { padding: 12px 10px; border-bottom: 1px solid #e7e5e4; font-size: 14px; }
        .footer { text-align: center; font-size: 12px; color: #78716c; margin-top: 32px; border-top: 1px solid #e7e5e4; padding-top: 16px; }
    </style>
</head>
<body>
    <div class="email-card">
        <div class="header">
            <div class="brand">Vogue & Velvet</div>
            <p style="margin: 6px 0 0; color: #78716c; font-size: 14px;">Dress Request Received</p>
        </div>

        <p>Dear {{ $itemRequest->customer_name }},</p>
        <p>Thank you for submitting your dress inquiry to <strong>Vogue & Velvet Luxury Couture</strong>. Our atelier stylists are reviewing your requested items and sizing notes.</p>

        <div style="background: #faf7f2; padding: 16px; border-radius: 8px; margin: 20px 0;">
            <p style="margin: 0 0 6px;"><strong>Request Reference Code:</strong> <span class="ref-badge">{{ $itemRequest->reference_code }}</span></p>
            <p style="margin: 0;"><strong>Date:</strong> {{ $itemRequest->created_at->format('M d, Y') }}</p>
        </div>

        <h3 style="font-size: 16px; color: #1c1917; margin-bottom: 8px; font-family: Georgia, serif;">Requested Items</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Dress Name</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($itemRequest->details as $detail)
                    <tr>
                        <td><strong>{{ $detail->product_name }}</strong></td>
                        <td>{{ $detail->quantity }}</td>
                        <td>${{ number_format($detail->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="font-size: 14px; color: #78716c; line-height: 1.6;">Our personal stylist will contact you via email at <strong>{{ $itemRequest->customer_email }}</strong> or phone to confirm sizing, custom tailoring requests, and delivery timelines.</p>

        <div class="footer">
            Vogue & Velvet Luxury Couture &bull; atelier@voguevelvet.com &bull; +1 (800) 789-VELVET
        </div>
    </div>
</body>
</html>
