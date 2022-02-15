<?php

namespace Dealskoo\MailList\Tests\Unit;

use Dealskoo\MailList\Models\Email;
use Dealskoo\MailList\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_country()
    {
        $email = Email::factory()->create();
        $this->assertNotNull($email->country);
    }
}
