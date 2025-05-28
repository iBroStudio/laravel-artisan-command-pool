<?php

declare(strict_types=1);

namespace IBroStudio\CommandPool\Tests\Support\Commands;

use Illuminate\Console\Command;

class Command3 extends Command
{
    protected $signature = 'command3';

    public function handle(): int
    {
        return Command::SUCCESS;
    }
}
