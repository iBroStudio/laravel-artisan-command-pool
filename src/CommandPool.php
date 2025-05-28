<?php

declare(strict_types=1);

namespace IBroStudio\CommandPool;

use IBroStudio\CommandPool\Dto\CommandDto;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;

class CommandPool
{
    /** @var array<string, string> */
    protected array $arguments = [];

    /**
     * @param  Collection<class-string<Command>|int, CommandDto>  $commands
     */
    public function __construct(
        public readonly Collection $commands,
        public readonly ?Command $poolCommander = null) {}

    /**
     * @param  array<int, class-string<Command>>|array<class-string<Command>, array<string, string>>  $commands
     */
    public static function pool(array $commands, ?Command $poolCommander = null): self
    {
        return new self(CommandDto::collectArray($commands), $poolCommander);
    }

    public function run(): int
    {
        $state = Command::SUCCESS;

        $this->commands->each(function (CommandDto $commandDto) use (&$state) {

            $state = ! is_null($this->poolCommander) ?
                $this->poolCommander->call($commandDto->command, $commandDto->arguments ?? $this->arguments)
                : Artisan::call($commandDto->command, $commandDto->arguments ?? $this->arguments);

            if ($state === Command::FAILURE) {
                return false;
            }
        });

        return $state;
    }

    /**
     * @param  array<string, string>  $arguments
     */
    public function runWith(array $arguments): int
    {
        $this->arguments = $arguments;

        return $this->run();
    }
}
