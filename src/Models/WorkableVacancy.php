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
}
