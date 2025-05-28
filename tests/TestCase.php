<?php

namespace IBroStudio\CommandPool\Tests;

use IBroStudio\CommandPool\CommandPoolServiceProvider;
use IBroStudio\CommandPool\Tests\Support\Commands\Command1;
use IBroStudio\CommandPool\Tests\Support\Commands\Command2;
use IBroStudio\CommandPool\Tests\Support\Commands\Command3;
use IBroStudio\CommandPool\Tests\Support\Commands\CommandFail;
use IBroStudio\CommandPool\Tests\Support\Commands\Contractor;
use Illuminate\Console\Application as Artisan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'IBroStudio\\CommandPool\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        Artisan::starting(function ($artisan) {
            $artisan->resolveCommands([
                Contractor::class,
                Command1::class,
                Command2::class,
                Command3::class,
                CommandFail::class,
            ]);
        });
    }

    protected function getPackageProviders($app)
    {
        return [
            CommandPoolServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
         foreach (\Illuminate\Support\Facades\File::allFiles(__DIR__ . '/database/migrations') as $migration) {
            (include $migration->getRealPath())->up();
         }
         */
    }
}
