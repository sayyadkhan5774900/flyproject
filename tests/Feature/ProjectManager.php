<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectManager extends TestCase
{

    use WithFaker, RefreshDatabase;

    /** @test **/
    public function an_authenticated_project_owner_is_required()
    {
        // $this->withoutExceptionHandling();

        $attributes = factory(Project::class)->raw();

        $this->post('/projects', $attributes)->assertRedirect('/login');
    }

    /** @test **/
    public function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];

        $this->actingAs(factory(User::class)->create());

        $this->get('/projects/create')->assertStatus(200);

        $this->post('/projects', $attributes)->assertRedirect('/projects');

        $this->assertDatabaseHas('projects', $attributes);

        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test **/
    public function a_guest_cannot_manage_projects()
    {

        $project = factory(Project::class)->create();

        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');

    }

    /** @test **/
    public function a_project_title_is_required()
    {
        // $this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $attributes = factory(Project::class)->raw(['title' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }

    /** @test **/
    public function a_project_description_is_required()
{
        // $this->withoutExceptionHandling();

        $this->actingAs(factory(User::class)->create());

        $attributes = factory(Project::class)->raw(['description' => '']);

        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }


    /** @test **/
    public function an_authenticated_user_can_view_project()
    {

        $user = factory(User::class)->create();

        $this->be($user);

        $project = factory(Project::class)->create(['user_id' => $user->id]);

        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }

    /** @test **/
    public function an_authenticated_user_cantnot_view__others_project()
    {
        $this->be(factory(User::class)->create());

        $project = factory(Project::class)->create();

        $this->get($project->path())->assertStatus(403);
    }
}
