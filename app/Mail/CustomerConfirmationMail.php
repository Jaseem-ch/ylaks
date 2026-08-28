<?php

namespace App\Mail;

use App\Models\ItemRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public ItemRequest $itemRequest;

    public function __construct(ItemRequest $itemRequest)
    {
        $this->itemRequest = $itemRequest;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Request Received: Reference {$this->itemRequest->reference_code} - ApexProcure",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.customer-confirmation',
        );
    }
}
