<?php

namespace App\VacanciesSearch;

use App\Vacancy;
use Illuminate\Database\Eloquent\Collection;

class EloquentVacanciesRepository implements VacanciesRepository
{
    public function search(string $query = ""): Collection
    {
        return Vacancy::where('body', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->get();
    }

    public function getNewest(int $count = 6): Collection
    {
        return Vacancy::orderBy('created_at', 'desc')
            ->limit($count)
            ->get();
    }
}