<?php

namespace App\Mail;

use App\Models\ItemRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompanyItemRequestMail extends Mailable
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
            subject: "[NEW ITEM REQUEST] {$this->itemRequest->reference_code} - {$this->itemRequest->customer_name} ({$this->itemRequest->company_name})",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.company-request',
        );
    }
}
