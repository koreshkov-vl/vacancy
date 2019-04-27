<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VacancyTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $vacancy = factory('App\Vacancy')->create();

        $this->assertEquals('/vacancies/' . $vacancy->id, $vacancy->path());
    }
}
