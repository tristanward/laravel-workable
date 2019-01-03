<?php

namespace Tristanward\LaravelWorkable;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Tristanward\LaravelWorkable\Models\WorkableVacancy;

class LaravelWorkable
{
    private $response;

    /**
     * Get raw data for all vacancies
     *
     * @param String $state
     * @return Illuminate\Support\Collection
     */
    public function vacancies($state = 'published')
    {
        $client = new Client(['base_uri' => config('laravel-workable.base_url')]);

        $this->response = $client->request('GET', '/spi/v3/jobs', [
            'headers' => [
                'Authorization' => 'Bearer ' . config('laravel-workable.access_token'),        
                'Accept' => 'application/json',
            ],
            'query' => [
                'state' => $state,
                'include_fields' => config('laravel-workable.include_fields'),
            ],
        ]);

        return collect($this->getData());
    }

    /**
     * Get data from response
     *
     * @return String
     */
    private function getData()
    {
        return json_decode($this->response->getBody()->getContents(), true)['jobs'];
    }
}