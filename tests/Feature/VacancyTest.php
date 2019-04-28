<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VacancyTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_vacancy()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory('App\User')->create());

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->get('/vacancies/create')->assertStatus(200);

        $this->post('/vacancies', $attributes)->assertRedirect('/vacancies');

        $this->assertDatabaseHas('vacancies', $attributes);

        $this->get('/vacancies')->assertSee($attributes['title']);
    }

    /** @test */
    public function a_vacancy_requires_a_title()
    {
        $this->actingAs(factory('App\User')->create());

        $attributes = factory('App\Vacancy')->raw(['title' => '']);
        $this->post('/vacancies', $attributes)->assertSessionHasErrors('title');
    }

    /** @test */
    public function a_vacancy_requires_a_description()
    {
        $this->actingAs(factory('App\User')->create());

        $attributes = factory('App\Vacancy')->raw(['description' => '']);
        $this->post('/vacancies', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function a_user_can_view_a_vacancy()
    {
        $this->withoutExceptionHandling();

        $vacancy = factory('App\Vacancy')->create();

        $this->get($vacancy->path())
            ->assertSee($vacancy->title)
            ->assertSee($vacancy->description);

    }

    /** @test */
    public function only_authenticated_users_can_create_vacancy()
    {
        $attributes = factory('App\Vacancy')->raw();
        $this->post('/vacancies', $attributes)->assertRedirect('login');
    }

    /** @test */
    public function only_authenticated_users_can_delete_vacancy()
    {
        $attributes = factory('App\Vacancy')->raw();
        $this->delete('/vacancies/{vacancy}/delete', $attributes)->assertRedirect('login');
    }
}
