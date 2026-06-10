<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        config(['database.connections.mysql.host' => env('DB_HOST', '127.0.0.1')]);
        config(['database.connections.mariadb.host' => env('DB_HOST', '127.0.0.1')]);
        \Illuminate\Support\Number::macro('format', function ($value) {
            return (string) $value;
        });
    }
}
