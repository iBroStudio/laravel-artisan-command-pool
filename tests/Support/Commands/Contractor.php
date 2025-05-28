<?php

declare(strict_types=1);

namespace IBroStudio\CommandPool\Tests\Support\Commands;

use IBroStudio\CommandPool\Concerns\HasCommandPool;
use Illuminate\Console\Command;

class Contractor extends Command
{
    use HasCommandPool;

    protected $signature = 'contractor {name}';

    public function handle(): int
    {
        return $this->commandPool([
            Command1::class,
            Command2::class => ['title' => 'tata'],
        ])->runWith(['name' => $this->argument('name')]);
    }
}
