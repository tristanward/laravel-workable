# Laravel Workable
A Workable API wrapper for Laravel. Easily access and cache Workable vacancies from your Workable account using the official Workable API.

## Installation
Install via composer:

```
$ composer require tristanward/laravel-workable
```

## Configuration
Laravel Workable requires your Workable account `subdomain` and an `access token` for your account.  For help finding these details please refer to the official Workable API documentation:

[https://workable.readme.io/docs/generate-an-access-token](https://workable.readme.io/docs/generate-an-access-token)

The Workable `subdomain` and `access token` should be configured in the Laravel `.env` file:

```
WORKABLE_SUBDOMAIN=your-sub-domain
WORKABLE_ACCESS_TOKEN=your-access-token

```
## Cache Workable Vacancies

Workable vacancies can be cached to limit calls to the Workable API.  To do this a `workable_vacancies` table must first be created using the included migration:

```
php artisan migrate
```

To cache all Workable vacancies use the `laravel-workable:cache` console command.  This command will remove all previously cached vacancies and replace them with the current published vacancies.

```
php artistan laravel-workable:cache
```

This command can be used in Laravel's default scheduler, for example to cache recent Workable vacancies at 03:00 on Sundays:

```php
// App/Console/Kernel.php

use Tristanward\LaravelWorkable\Console\LaravelWorkableCache;

protected $commands = [
    ...
    LaravelWorkableCache::class,
];

protected function schedule(Schedule $schedule)
{
    ...
    $schedule->command('laravel-workable:cache')
        ->sundays()
        ->at('03:00');
}
```
