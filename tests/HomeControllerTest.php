<?php

namespace Tests;

use App\Core\Bootstrapper;

class HomeControllerTest extends BasicTest
{
    protected function setUp(): void
    {
        Bootstrapper::setUp();
    }

    public function testHomepage()
    {
        $response = file_get_contents('http://bless-nginx');
        self::assertTrue(str_contains($response, _('home.subheader')));
    }
}
