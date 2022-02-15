<?php

namespace Dealskoo\MailList\Tests\Feature\Admin;

use Dealskoo\Admin\Models\Admin;
use Dealskoo\MailList\Events\Subscribed;
use Dealskoo\MailList\Events\Unsubscribed;
use Dealskoo\MailList\Models\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dealskoo\MailList\Tests\TestCase;
use Illuminate\Support\Facades\Event;

class MailListControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        $admin = Admin::factory()->isOwner()->create();
        $response = $this->actingAs($admin, 'admin')->get(route('admin.mail-lists.index'));
        $response->assertStatus(200);
    }

    public function test_table()
    {
        $admin = Admin::factory()->isOwner()->create();
        $response = $this->actingAs($admin, 'admin')->get(route('admin.mail-lists.index'), ['HTTP_X-Requested-With' => 'XMLHttpRequest']);
        $response->assertJsonPath('recordsTotal', 0);
        $response->assertStatus(200);
    }

    public function test_create()
    {
        $admin = Admin::factory()->isOwner()->create();
        $response = $this->actingAs($admin, 'admin')->get(route('admin.mail-lists.create'));
        $response->assertStatus(200);
    }

    public function test_store()
    {
        Event::fake();
        $admin = Admin::factory()->isOwner()->create();
        $email = Email::factory()->make();
        $response = $this->actingAs($admin, 'admin')->post(route('admin.mail-lists.store'), $email->only([
            'first_name',
            'last_name',
            'email',
            'tag',
            'country_id'
        ]));
        $response->assertStatus(302);
        Event::assertDispatched(Subscribed::class);
    }

    public function test_show()
    {
        $admin = Admin::factory()->isOwner()->create();
        $email = Email::factory()->create();
        $response = $this->actingAs($admin, 'admin')->get(route('admin.mail-lists.show', $email));
        $response->assertStatus(200);
    }

    public function test_edit()
    {
        $admin = Admin::factory()->isOwner()->create();
        $email = Email::factory()->create();
        $response = $this->actingAs($admin, 'admin')->get(route('admin.mail-lists.edit', $email));
        $response->assertStatus(200);
    }

    public function test_update()
    {
        $admin = Admin::factory()->isOwner()->create();
        $email = Email::factory()->create();
        $email1 = Email::factory()->make();
        $response = $this->actingAs($admin, 'admin')->put(route('admin.mail-lists.update', $email), $email1->only([
            'first_name',
            'last_name',
            'email',
            'tag',
            'country_id'
        ]));
        $response->assertStatus(302);
    }

    public function test_destroy()
    {
        Event::fake();
        $admin = Admin::factory()->isOwner()->create();
        $email = Email::factory()->create();
        $response = $this->actingAs($admin, 'admin')->delete(route('admin.mail-lists.destroy', $email));
        $response->assertStatus(200);
        $this->assertSoftDeleted($email);
        Event::assertDispatched(Unsubscribed::class);
    }
}
