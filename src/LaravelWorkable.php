<?php

namespace Tristanward\LaravelWorkable;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Tristanward\LaravelWorkable\Models\WorkableVacancy;

class LaravelWorkable
{
    /**
     * Get raw data for all vacancies
     *
     * @param String $state
     * @return Illuminate\Support\Collection
     */
    public function vacancies($state = 'published')
    {
        $client = new Client(['base_uri' => config('laravel-workable.base_url')]);

        $response = $client->request('GET', '/spi/v3/jobs', [
            'headers' => [
                'Authorization' => 'Bearer ' . config('laravel-workable.access_token'),        
                'Accept' => 'application/json',
            ],
            'query' => [
                'state' => $state,
                'include_fields' => config('laravel-workable.include_fields'),
            ],
        ]);
        
        return collect($this->decodeContents($response)['jobs']);
    }

    /**
     * Get full data for a specific vacancy using shortcode
     *
     * @param String $shortcode
     * @param String $state
     * @return Array
     */
    public function vacancy($shortcode, $state = 'published')
    {
        $client = new Client(['base_uri' => config('laravel-workable.base_url')]);

        $response = $client->request('GET', '/spi/v3/jobs/' . $shortcode, [
            'headers' => [
                'Authorization' => 'Bearer ' . config('laravel-workable.access_token'),        
                'Accept' => 'application/json',
            ],
            'query' => [
                'state' => $state,
            ],
        ]);

        return $this->decodeContents($response);
    }

    /**
     * Get contents from a GuzzleHttp Response and decode json
     *
     * @param GuzzleHttp\Psr7\Response $response
     * @return Array
     */
    private function decodeContents($response)
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}