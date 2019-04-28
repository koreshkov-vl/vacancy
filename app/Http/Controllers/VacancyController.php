<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;
use App\VacanciesSearch\VacanciesRepository;
use Illuminate\Support\Facades\Session;

class VacancyController extends Controller
{
    const PAGINATION_CONST = 10;

    public function index(VacanciesRepository $vacanciesRepository)
    {
        $vacancies = $vacanciesRepository->getNewest()->toArray();

        return view('vacancies.index', compact('vacancies'));
    }

    public function show(int $vacancyId)
    {
        Vacancy::increaseViews($vacancyId);
        $vacancy = Vacancy::getWithOwner($vacancyId);

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
        $attributes['views'] = 0;

        auth()->user()->vacancies()->create($attributes);

        Session::flash('message.level', 'success');
        Session::flash('message.content', 'Created!');

        return redirect('/vacancies/admin');
    }

    public function edit(int $vacancy)
    {
        $vacancy = Vacancy::getWithOwner($vacancy);

        return view('vacancies.edit', compact('vacancy'));
    }

    public function update(int $vacancy)
    {
        $attributes = \request();

        try {
            $vacancy = Vacancy::find($vacancy);
            $vacancy->title = $attributes['title'];
            $vacancy->description = $attributes['description'];
            $vacancy->save();
            Session::flash('message.level', 'info');
            Session::flash('message.content', 'Updated');
        } catch (\Exception $e) {
            Session::flash('message.level', 'danger');
            Session::flash('message.content', 'Failure!');
        }

        return redirect('/vacancies/admin');
    }


    public function delete(int $vacancy)
    {
        try {
            Vacancy::destroy([$vacancy]);
            Session::flash('message.level', 'info');
            Session::flash('message.content', 'Deleted');
        } catch (\Exception $e) {
            Session::flash('message.level', 'danger');
            Session::flash('message.content', 'Failure!');
        }

        return redirect('/vacancies/admin');
    }
}
