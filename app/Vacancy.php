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

    public static function getNewest(int $count = 6)
    {
        $vacancies = DB::table('vacancies')
            ->orderBy('created_at', 'desc')
            ->limit($count)
            ->selectRaw('vacancies.*, CONCAT(\'/vacancies/\', vacancies.id) as path')
            ->get();

        return $vacancies;
    }

    public static function pagination(int $paginationCount)
    {
        $vacancies = DB::table('vacancies')
            ->join('users', 'users.id', '=', 'vacancies.owner_id')
            ->orderBy('created_at', 'desc')
            ->selectRaw(
                'vacancies.*, 
                users.name as user_name, 
                users.email as user_email, 
                CONCAT(\'/vacancies/\', vacancies.id) as path,
                CONCAT(\'/vacancies/\', vacancies.id, \'/delete\') as delete_path')
            ->paginate($paginationCount);

        return $vacancies;
    }

    public static function getWithOwner(int $vacancyId)
    {
        $vacancy = DB::table('vacancies')
            ->join('users', 'users.id', '=', 'vacancies.owner_id')
            ->where('vacancies.id', $vacancyId)
            ->selectRaw('
                vacancies.*,
                users.name as user_name,
                users.email as user_email,
                CONCAT(\'/vacancies/\', vacancies.id, \'/delete\') as delete_path')
            ->first();

        return $vacancy;
    }
}
