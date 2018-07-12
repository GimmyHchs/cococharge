<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Mockery;
use Mockery\MockInterface;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @param string $class
     *
     * @return Mockery
     */
    public function mock(string $class): MockInterface
    {
        $mock = Mockery::mock($class);
        $this->app->instance($class, $mock);

        return $mock;
    }

    public function bindToInterface(string $interface, $instance): void
    {
        $this->app->bind($interface, get_class($instance));
        $this->app->instance(get_class($instance), $instance);
    }
}
