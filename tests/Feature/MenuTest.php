<?php

namespace Dealskoo\MailList\Tests\Feature;

use Dealskoo\Admin\Facades\AdminMenu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dealskoo\MailList\Tests\TestCase;

class MenuTest extends TestCase
{
    use RefreshDatabase;

    public function test_menu()
    {
        $this->assertNotNull(AdminMenu::findBy('title', 'mail-list::mail-list.mail-lists'));
    }
}
