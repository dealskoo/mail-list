<?php

namespace Dealskoo\MailList\Events;

use Dealskoo\MailList\Models\Email;

class Event
{
    public $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }
}
