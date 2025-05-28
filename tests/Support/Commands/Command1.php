<?php

declare(strict_types=1);

namespace IBroStudio\CommandPool\Tests\Support\Commands;

use Illuminate\Console\Command;

class Command1 extends Command
{
    protected $signature = 'command1 {name}';

    public function handle(): int
    {
        return Command::SUCCESS;
    }
}
