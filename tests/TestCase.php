<?php

namespace Dealskoo\MailList\Tests;

use Dealskoo\MailList\Providers\MailListServiceProvider;

abstract class TestCase extends \Dealskoo\Admin\Tests\TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            MailListServiceProvider::class
        ];
    }

    protected function getPackageAliases($app)
    {
        return [];
    }
}
