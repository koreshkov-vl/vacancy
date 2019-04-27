<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Vacancy;
use Illuminate\Support\Facades\Session;

class VacancyController extends Controller
{
    const PAGINATION_CONST = 10;

    public function index() {

        $vacancies = Vacancy::getNewest();

        return view('vacancies.index', compact('vacancies'));
    }

    public function show(int $vacancy)
    {
        $vacancy = Vacancy::getWithOwner($vacancy);

        return view('vacancies.show', compact('vacancy'));
    }

    public function create()
    {
        return view('vacancies.create');
    }

    public function admin()
    {
        $vacancies = Vacancy::pagination(self::PAGINATION_CONST);

        return view('vacancies.admin', compact('vacancies'));
    }

    public function store() {
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        auth()->user()->vacancies()->create($attributes);

        Session::flash('message.level', 'success');
        Session::flash('message.content', 'Created');

        return redirect('/vacancies');
    }

    public function delete(int $vacancy)
    {
        try {
            Vacancy::where('id', $vacancy)->delete();
            Session::flash('message.level', 'info');
            Session::flash('message.content', 'Deleted');
        } catch (\Exception $e) {
            Session::flash('message.level', 'danger');
            Session::flash('message.content', 'Failure!');
        }

        return redirect('/vacancies/admin');
    }
}
