<?php

namespace App\Providers;

use Github\Client as GitHubClient;
use Github\HttpClient\Builder;
use Illuminate\Support\ServiceProvider;

class GitHubServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(GitHubClient::class, function ($app) {
            $client = new GitHubClient(null, 'squirrel-girl-preview');
            $client->authenticate(config('services.github.client_id'), config('services.github.client_secret'), GitHubClient::AUTH_URL_CLIENT_ID);

            return $client;
        });

        $this->app->singleton(GitHub::class, function () {
            return new GitHub(app(GitHubClient::class));
        });
    }
}
