<?php

use Illuminate\Console\Command;
use App\Models\Event;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventReminderMail;
use Carbon\Carbon;

class SendEventReminders extends Command
{
    protected $signature = 'events:send-reminders';
    protected $description = 'Send event email reminders 24h, 1h, and at event start time';

    public function handle()
    {
        $now = Carbon::now();

        $events = Event::where('start_time', '>', $now)->get();

        foreach ($events as $event) {
            $start = Carbon::parse($event->start_time);
            $diffInMinutes = $now->diffInMinutes($start, false);

            // Avoid sending duplicates — use a flag in DB or a cache key
            if ($diffInMinutes === 1440) {
                $this->sendReminder($event, '24-hour');
            } elseif ($diffInMinutes === 60) {
                $this->sendReminder($event, '1-hour');
            } elseif ($diffInMinutes === 0) {
                $this->sendReminder($event, 'start');
            }
        }
    }

    protected function sendReminder($event, $type)
    {
        // You can store a flag on the event or use cache to avoid resending
        $email = $event->organizer; // or a list of attendees

        Mail::to($email)->send(new EventReminderMail($event, $type));

        $this->info("Sent $type reminder for event: " . $event->event_name);
    }
}
