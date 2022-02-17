<?php

namespace Dealskoo\MailList\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class Unsubscribed extends Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
}
