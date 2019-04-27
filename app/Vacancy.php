<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vacancy extends Model
{
    protected $guarded = [];

    public function path()
    {
        return "/vacancies/{$this->id}";
    }

    public static function getNewest($count = 6)
    {
        $vacancies = DB::table('vacancies')
            ->orderBy('created_at', 'desc')
            ->limit($count)
            ->get();

        return $vacancies;
    }

}
