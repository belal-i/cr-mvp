<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Inquiry extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public function __construct(
        //public $id,
        public $sourceId,
        public $appointmentWanted,
        public $apartmentQuestions,
        public $maxRent,
        public $firstName,
        public $lastName,
        public $numberOfRoomsMin,
        public $startDate,
        public $latestMoveInDate,
        public $minMonths,
        public $personsInfo,
        public $neighborhood,
        public $petsInfo,
        public $jobType,
        public $salutation,
        public $title,
        public $company,
        public $email,
        public $phone,
        public $other,
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Anfrage zu Objekt ' . $this->sourceId,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.inquiry',
        );
    }

    // TODO: Do this in the future?
    // https://laravel.com/docs/11.x/mail#attaching-files-from-disk
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
