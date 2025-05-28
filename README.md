# Simplify and organize Artisan commands executed programmatically

## Installation

You can install the package via composer:

```bash
composer require ibrostudio/laravel-artisan-command-pool
```

**Each command in the pool has to return a Illuminate\Console\Command int state (Command::SUCCESS or Command::FAILURE)**

## Run statically

```php
use IBroStudio\CommandPool\CommandPool;

CommandPool::pool([
    Command1::class,
    Command2::class,
])->run()
```

**With command arguments (passed to each command in pool):**

```php
use IBroStudio\CommandPool\CommandPool;

CommandPool::pool([
    Command1::class,
    Command2::class,
])->runWith(['name' => 'Name'])
```

**With different arguments for each command in pool:**

```php
use IBroStudio\CommandPool\CommandPool;

CommandPool::pool([
    Command1::class => ['name' => 'Name'],
    Command2::class => ['title' => 'Title'],
])->run()
```

or

```php
use IBroStudio\CommandPool\CommandPool;

CommandPool::pool([
    Command1::class,
    Command2::class => ['title' => 'Title'],
])->runWith(['name' => 'Name'])
```

## Run from another command

```php
use IBroStudio\CommandPool\Concerns\HasCommandPool;

class MyContractorCommand extends Command
{
    use HasCommandPool;

    public function handle(): int
    {
        return $this->commandPool([
            Command1::class,
            Command2::class,
        ])->run();

        //or
        return $this->commandPool([
            Command1::class,
            Command2::class => ['title' => 'tata'],
        ])->runWith(['name' => $this->argument('name')]);
    }
```

## Credits

- [iBroStudio](https://github.com/iBroStudio)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
