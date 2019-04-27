<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vacancy;

class VacancyController extends Controller
{
    public function index() {

        $vacancies = Vacancy::getNewest();

        return view('vacancies.index', compact('vacancies'));
    }

    public function show(Vacancy $vacancy)
    {
        return view('vacancies.show', compact('vacancy'));
    }

    public function create()
    {
        return view('vacancies.create');
    }

    public function store() {
        $attributes = request()->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        auth()->user()->vacancies()->create($attributes);

        return redirect('/vacancies');
    }
}
