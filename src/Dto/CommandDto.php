<?php

declare(strict_types=1);

namespace IBroStudio\CommandPool\Dto;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class CommandDto extends Data
{
    /**
     * @param  class-string<Command>  $command
     * @param  array<string, string>|null  $arguments
     */
    public function __construct(
        public string $command,
        public ?array $arguments = null,
    ) {}

    /**
     * @param  array<int, class-string<Command>>|array<class-string<Command>, array<string, string>>  $items
     * @return Collection<class-string<Command>|int, CommandDto>
     */
    public static function collectArray(array $items): Collection
    {
        return collect($items)
            ->map(function (array|string $item, int|string $key) {
                return is_string($key) ?
                    new self($key, $item)
                    : new self($item);
            });
    }
}
