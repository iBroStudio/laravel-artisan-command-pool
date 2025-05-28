<?php

declare(strict_types=1);

namespace IBroStudio\CommandPool\Tests\Support\Commands;

use Illuminate\Console\Command;

class CommandFail extends Command
{
    protected $signature = 'command-fail';

    public function handle(): int
    {
        return Command::FAILURE;
    }
}
