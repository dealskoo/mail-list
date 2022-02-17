<?php

namespace Dealskoo\MailList\Tests\Feature;

use Dealskoo\Country\Models\Country;
use Dealskoo\MailList\Events\Subscribed;
use Dealskoo\MailList\Models\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dealskoo\MailList\Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\URL;

class MailListControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Country::factory(['alpha2' => config('country.default_alpha2')])->create();
        URL::defaults([config('country.prefix') => \request()->country()->alpha2]);
    }

    public function test_handle()
    {
        Event::fake();
        $email = Email::factory()->make();
        $response = $this->post(route('mail-list'), $email->only([
            'first_name',
            'last_name',
            'email'
        ]));
        $response->assertStatus(302);
        Event::assertDispatched(Subscribed::class);
    }

    public function test_handle_ajax()
    {
        Event::fake();
        $email = Email::factory()->make();
        $response = $this->post(route('mail-list'), $email->only([
            'first_name',
            'last_name',
            'email'
        ]), [
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);
        $response->assertStatus(200);
        Event::assertDispatched(Subscribed::class);
    }
}
