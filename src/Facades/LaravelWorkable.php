<?php

namespace Tristanward\LaravelWorkable\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelWorkable extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'LaravelWorkable';
    }
}