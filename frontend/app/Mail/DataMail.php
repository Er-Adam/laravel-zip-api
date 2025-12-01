<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Headers;
use Illuminate\Queue\SerializesModels;

class DataMail extends Mailable
{
    use Queueable, SerializesModels;

    public $inData;
    public $subjectType;

    public function __construct($subjectType, $data)
    {
        $this->subjectType = $subjectType;
        $this->inData = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Data Mail: $this->subjectType",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.datamail',
            with: [
                'title' => $this->inData['title'],
                'data' => $this->inData['data'],
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
