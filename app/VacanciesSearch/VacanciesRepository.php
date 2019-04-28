<?php

namespace App\VacanciesSearch;

use Illuminate\Database\Eloquent\Collection;

interface VacanciesRepository
{
    public function search(string $query = ""): Collection;
}