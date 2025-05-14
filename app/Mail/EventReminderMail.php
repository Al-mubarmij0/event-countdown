<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;

class EventReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $type;

    /**
     * Create a new message instance.
     */
    public function __construct(Event $event, string $type)
    {
        $this->event = $event;
        $this->type = $type;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = match ($this->type) {
            '24-hour' => 'Reminder: Your event "' . $this->event->event_name . '" is in 24 hours',
            '1-hour'  => 'Reminder: Your event "' . $this->event->event_name . '" is in 1 hour',
            'start'   => 'Your event "' . $this->event->event_name . '" is starting now!',
            default   => 'Event Reminder',
        };

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.event-reminder',
            with: [
                'event' => $this->event,
                'type' => $this->type,
            ],
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
