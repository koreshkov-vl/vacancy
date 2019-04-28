<?php

namespace App\VacanciesSearch;

use App\Vacancy;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Collection;

class ElasticsearchVacanciesRepository implements VacanciesRepository
{
    private $search;

    public function __construct(Client $client) {
        $this->search = $client;
    }

    public function search(string $query = ""): Collection
    {
        $items = $this->searchOnElasticsearch($query);

        return $this->buildCollection($items);
    }

    public function getNewest(int $count = 6): Collection
    {
        $items = $this->getNewestFromElasticsearch($count);

        return $this->buildCollection($items);
    }

    private function getNewestFromElasticsearch(int $count): array
    {
        $instance = new Vacancy;

        $items = $this->search->search([
            'index' => $instance->getSearchIndex(),
            'type' => $instance->getSearchType(),
            'size' => $count,
            'body' => [
                'sort' => [
                    'id' => [
                        'order' => 'desc'
                    ]
                ]
            ],
        ]);

        return $items;
    }

    private function searchOnElasticsearch(string $query): array
    {
        $instance = new Vacancy;

        $items = $this->search->search([
            'index' => $instance->getSearchIndex(),
            'type' => $instance->getSearchType(),
            'body' => [
                'query' => [
                    'multi_match' => [
                        'fields' => ['title', 'body'],
                        'query' => $query,
                    ],
                ],
            ],
        ]);

        return $items;
    }

    private function buildCollection(array $items): Collection
    {
        /**
         * [
         *      'hits' => [
         *          'hits' => [
         *              [ '_source' => 1 ],
         *              [ '_source' => 2 ],
         *          ]
         *      ]
         * ]
         */
        $hits = array_pluck($items['hits']['hits'], '_source') ?: [];

        return Vacancy::hydrate($hits);
    }
}