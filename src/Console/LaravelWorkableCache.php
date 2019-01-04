<?php

namespace Tristanward\LaravelWorkable\Console;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Tristanward\LaravelWorkable\Facades\LaravelWorkable;
use Tristanward\LaravelWorkable\Models\WorkableVacancy;

class LaravelWorkableCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laravel-workable:cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache all current workable vacancies.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Remove all previously cached vacancies
        WorkableVacancy::truncate();

        LaravelWorkable::vacancies()
            ->each(function($vacancy) {
                WorkableVacancy::create([
                    'vacancy_id' => $vacancy['id'],
                    'title' => $vacancy['title'],
                    'full_title' => $vacancy['full_title'],
                    'shortcode' => $vacancy['shortcode'],
                    'code' => $vacancy['code'],
                    'state' => $vacancy['state'],
                    'department' => $vacancy['department'],
                    'url' => $vacancy['url'],
                    'application_url' => $vacancy['application_url'],
                    'shortlink' => $vacancy['shortlink'],
                    'country' => $vacancy['location']['country'],
                    'region' => $vacancy['location']['region'],
                    'city' => $vacancy['location']['city'],
                    'zip_code' => $vacancy['location']['zip_code'],
                    'workable_created_at' => $vacancy['created_at'],
                    'description' => $vacancy['description'],
                    'requirements' => $vacancy['requirements'],
                    'benefits' => $vacancy['benefits'],
                    'employment_type' => $vacancy['employment_type'],
                ]);
            });
    }
}
