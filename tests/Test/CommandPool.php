<?php

declare(strict_types=1);

use IBroStudio\CommandPool\CommandPool;
use IBroStudio\CommandPool\Tests\Support\Commands\Command1;
use IBroStudio\CommandPool\Tests\Support\Commands\Command2;
use IBroStudio\CommandPool\Tests\Support\Commands\Command3;
use IBroStudio\CommandPool\Tests\Support\Commands\CommandFail;
use IBroStudio\CommandPool\Tests\Support\Commands\Contractor;
use Illuminate\Console\Command;

use function Pest\Laravel\artisan;

it('can run a pool', function () {
    expect(
        CommandPool::pool([
            Command3::class,
        ])->run()
    )->toBe(Command::SUCCESS);
});

it('can run a pool with arguments', function () {
    expect(
        CommandPool::pool([
            Command1::class,
        ])->runWith(['name' => 'test'])
    )->toBe(Command::SUCCESS);
});

it('can run a pool with dedicated arguments', function () {
    expect(
        CommandPool::pool([
            Command1::class,
            Command2::class => ['title' => 'test'],
        ])->runWith(['name' => 'test'])
    )->toBe(Command::SUCCESS);
});

it('can run a pool with condition', function () {
    expect(
        CommandPool::pool([
            CommandFail::class => ['runIf' => fn (): bool => false],
            Command2::class => ['title' => 'test'],
        ])->run()
    )->toBe(Command::SUCCESS);
});

it('can run a pool from a contractor command', function () {
    artisan(Contractor::class, ['name' => 'test'])->assertOk();
});
