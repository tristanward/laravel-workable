<?php

namespace Tristanward\LaravelWorkable\Models;

use Illuminate\Database\Eloquent\Model;

class WorkableVacancy extends Model
{
    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * Get all unique locations from workable vacancies
     *
     * @return Array
     */
    public static function uniqueLocations()
    {
        return self::pluck('city')->unique()->sort()->all();
    }

    /**
     * Get all unique positions from workable vacancies
     *
     * @return Array
     */
    public static function uniquePositions()
    {
        return self::pluck('title')->unique()->sort()->all();
    }
}
