<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InquiryClientConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public $salutation,
        public $name,
        public $maxRent,
        public $numberOfRoomsMin,
        public $startDate,
        public $minMonths,
        public $offerId,
        public $greeting = null,
    )
    {
        switch ($salutation) {
            case 'Familie':
            case 'Frau Dr.':
            case 'Frau':
                $this->greeting = "Sehr geehrte {$salutation} {$name},";
                break;
            case 'Herr Dr.':
            case 'Herr':
                $this->greeting = "Sehr geehrter {$salutation} {$name},";
                break;
            default:
                $this->greeting = "Sehr geehrte Frau {$name}, sehr geehrter Herr {$name},";
                break;
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Vielen Dank für Ihren Auftrag',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.inquiry-client-confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
