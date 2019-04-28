<?php

namespace App\Providers;

use App\VacanciesSearch\ElasticsearchVacanciesRepository;
use App\VacanciesSearch\EloquentVacanciesRepository;
use App\VacanciesSearch\VacanciesRepository;
use Illuminate\Support\ServiceProvider;
use Elasticsearch\Client;
use Elasticsearch\ClientBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(VacanciesRepository::class, function($app) {
            if (!config('services.search.enabled')) {
                return new EloquentVacanciesRepository();
            }

            return new ElasticsearchVacanciesRepository(
                $app->make(Client::class)
            );
        });

        $this->bindSearchClient();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts(config('services.search.hosts'))
                ->build();
        });
    }
}
