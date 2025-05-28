<?php

declare(strict_types=1);

namespace IBroStudio\CommandPool\Tests\Support\Commands;

use Illuminate\Console\Command;

class Command2 extends Command
{
    protected $signature = 'command2 {title}';

    public function handle(): int
    {
        return Command::SUCCESS;
    }
}
