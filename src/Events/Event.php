<?php

namespace Dealskoo\MailList\Events;

use Dealskoo\MailList\Models\Email;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }
}
