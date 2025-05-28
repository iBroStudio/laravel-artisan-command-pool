<?php

declare(strict_types=1);

namespace IBroStudio\CommandPool\Concerns;

use IBroStudio\CommandPool\CommandPool;

trait HasCommandPool
{
    public function commandPool(array $commands): CommandPool
    {
        return CommandPool::pool($commands, $this);
    }
}
