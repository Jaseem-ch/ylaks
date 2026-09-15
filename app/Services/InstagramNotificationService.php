<?php

namespace App\Services;

use App\Models\ItemRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InstagramNotificationService
{
    /**
     * Send Instagram DM Notification for a new Dress Request.
     *
     * @param ItemRequest $itemRequest
     * @return bool
     */
    public static function sendRequestNotification(ItemRequest $itemRequest): bool
    {
        $handle = $itemRequest->instagram_handle ? '@' . ltrim($itemRequest->instagram_handle, '@') : 'N/A';
        $companyInstagram = env('COMPANY_INSTAGRAM_HANDLE', '@vogueandvelvet');
        
        // Build Instagram DM Message Text
        $itemsText = "";
        foreach ($itemRequest->details as $detail) {
            $itemsText .= "• {$detail->quantity}x {$detail->product_name} (\${$detail->subtotal})\n";
        }

        $message = "✨ NEW DRESS REQUEST RECEIVED ✨\n\n"
            . "Ref Code: {$itemRequest->reference_code}\n"
            . "Customer: {$itemRequest->customer_name}\n"
            . "IG Handle: {$handle}\n"
            . "Email: {$itemRequest->customer_email}\n"
            . "Phone: {$itemRequest->customer_phone}\n\n"
            . "Requested Dresses:\n" . $itemsText . "\n"
            . "Estimated Total: $" . number_format($itemRequest->total_estimated_value, 2) . "\n\n"
            . "Our Atelier Stylists have logged this request and will send fitting confirmation shortly!\n"
            . "Thank you for choosing {$companyInstagram} Couture.";

        $accessToken = config('services.instagram.access_token', env('INSTAGRAM_PAGE_ACCESS_TOKEN'));
        $recipientIgId = config('services.instagram.recipient_id', env('INSTAGRAM_RECIPIENT_ID'));

        $success = false;

        // 1. Send via Instagram Messaging Graph API if credentials exist
        if (!empty($accessToken) && !empty($recipientIgId)) {
            try {
                $response = Http::post("https://graph.facebook.com/v18.0/me/messages", [
                    'recipient' => ['id' => $recipientIgId],
                    'message' => ['text' => $message],
                    'access_token' => $accessToken,
                ]);

                if ($response->successful()) {
                    $success = true;
                    Log::info("Instagram DM sent successfully for Ref {$itemRequest->reference_code}");
                } else {
                    Log::warning("Instagram Graph API Response Failed: " . $response->body());
                }
            } catch (\Exception $e) {
                Log::error("Instagram API Exception: " . $e->getMessage());
            }
        }

        // 2. Always log to dedicated Instagram dispatch log file for verification
        $logPayload = "[" . date('Y-m-d H:i:s') . "] INSTAGRAM DM NOTIFICATION:\n"
            . "Target IG Account: {$handle} & {$companyInstagram}\n"
            . "Message Content:\n" . $message . "\n"
            . "---------------------------------------------------------\n";

        @file_put_contents(storage_path('logs/instagram_messages.log'), $logPayload, FILE_APPEND);
        Log::info("Instagram notification recorded in storage/logs/instagram_messages.log for Ref {$itemRequest->reference_code}");

        $itemRequest->update(['instagram_sent_at' => now()]);

        return true;
    }
}
