<?php

namespace BeetechAsia\VNPay\Tests;

use BeetechAsia\VNPay\VNPayServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function getEnvironmentSetUp($app): void
    {
        config()->set([
            'app.faker_locale' => 'vi_VN',
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'BeetechAsia\\VNPay\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app): array
    {
        return [
            VNPayServiceProvider::class,
        ];
    }
}
