<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Mockery;
use Mockery\MockInterface;
use Tests\Traits\MessagePrintable;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, MessagePrintable;

    /**
     * @param string $class
     *
     * @return Mockery
     */
    public function initMock(string $class): MockInterface
    {
        $mock = Mockery::mock($class);
        $this->app->instance($class, $mock);

        return $mock;
    }
}
