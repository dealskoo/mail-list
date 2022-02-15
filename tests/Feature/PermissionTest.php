<?php

namespace Dealskoo\MailList\Tests\Feature;

use Dealskoo\Admin\Facades\PermissionManager;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dealskoo\MailList\Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_permissions()
    {
        $this->assertNotNull(PermissionManager::getPermission('mail-lists.index'));
        $this->assertNotNull(PermissionManager::getPermission('mail-lists.show'));
        $this->assertNotNull(PermissionManager::getPermission('mail-lists.create'));
        $this->assertNotNull(PermissionManager::getPermission('mail-lists.edit'));
        $this->assertNotNull(PermissionManager::getPermission('mail-lists.destroy'));
    }
}
