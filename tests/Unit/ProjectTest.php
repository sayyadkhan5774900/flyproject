<?php

namespace Tests\Unit;

use App\Project;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ProjectTest extends TestCase
{

    use RefreshDatabase;

    /** @test **/
    public function it_has_a_path()
    {
        $this->withoutExceptionHandling();

        $project = factory(Project::class)->create();

        $this->assertEquals('/projects/' . $project->id, $project->path());
    }


    /** @test **/
    public function it_belongs_to_an_user()
    {
        $this->withoutExceptionHandling();

        $project = factory(Project::class)->create();

        $this->assertInstanceOf(User::class, $project->user);
    }



}
