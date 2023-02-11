<?php

namespace App\Services\Twitter;

use Noweh\TwitterApi\Client;

class TwitterService
{
    
    private Client $client;

    public function __construct()
    {
        $settings = [
            'account_id' => config('services.twitter.user_id'),
            'consumer_key' => config('services.twitter.consumer_key'),
            'consumer_secret' => config('services.twitter.consumer_secret'),
            'bearer_token' => config('services.twitter.consumer_bearer_token'),
            'access_token' => config('services.twitter.access_token'),
            'access_token_secret' => config('services.twitter.access_secret')
        ];

        $this->client = new Client($settings);
    }

    /**
     * Post a tweet
     *
     * @param array $tweet['text', 'image']
     * @return void
     */
    public function tweet(string $tweet, string $media = null)
    {
        return $this->client->tweet()->performRequest('POST', [
            'text' => $tweet,
        ]);
    }
}