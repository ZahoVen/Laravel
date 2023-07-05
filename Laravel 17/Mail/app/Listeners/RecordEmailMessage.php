<?php

namespace App\Listeners;

use App\Models\Message;

class RecordEmailMessage
{
    public function handle($event)
    {
        // Access the received message from the event
        $message = $event->message;

        // Create a new record in the messages table
        Message::create([
            'name' => $message->name,
            'email' => $message->email,
            'message' => $message->message,
        ]);
    }
}
