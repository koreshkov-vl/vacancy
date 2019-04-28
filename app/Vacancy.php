<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Search\Searchable;

class Vacancy extends Model
{
    use Searchable;

    protected $guarded = [];

    public function path()
    {
        return "/vacancies/{$this->id}";
    }

    public static function pagination(int $paginationCount)
    {
        $vacancies = DB::table('vacancies')
            ->join('users', 'users.id', '=', 'vacancies.owner_id')
            ->orderBy('created_at', 'desc')
            ->selectRaw(
                'vacancies.*, 
                users.name as user_name, 
                users.email as user_email')
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
                users.email as user_email')
            ->first();

        return $vacancy;
    }

    public static function increaseViews(int $vacancyId)
    {
        $vacancy = Vacancy::find($vacancyId);
        $vacancy->views++;
        $vacancy->save();
    }
}
