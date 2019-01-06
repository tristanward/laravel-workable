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

This command can be used in Laravel's default scheduler, for example to cache all published Workable vacancies at 03:00 on Sundays:

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

## Using cached Workable vacancies
Once Workable vacancies have been cached they can be used like a normal Laravel eloquent model:

```php
<?php

use Tristanward\LaravelWorkable\Models\WorkableVacancy;

// Get all cached Workable vacancies
$vacancies = WorkableVacancy::all();

// Get an array of all unique vacancy locations
$locations = WorkableVacancy::uniqueLocations();

// Get an array of all unique vacancy positions
$positions = WorkableVacancy::uniquePositions();
```

## Direct API Usage
Laravel Workable also provides a Laravel facade to use the Workable API wrapper if needed.  These functions use the Workable API directly so you need to consider API access rate limitations.

```php
<?php

use Tristanward\LaravelWorkable\Facades\LaravelWorkable;

// Get all published workable vacancies
$vacancies = WorkableVacancy::all();

// Alternatively, a state may be provided
$vacancies = WorkableVacancy::all($state = 'draft');

// Full data for a single vacancy can be accessed with it's $shortcode
$vacancy = LaravelWorkable::vacancy($shortcode = 'ABCDEFGHIJ')
```

# Thanks
[https://www.tristanward.co.uk](https://www.tristanward.co.uk)