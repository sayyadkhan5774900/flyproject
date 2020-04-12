<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    /** @test **/
    public function a_user_has_projects()
    {

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->assertNotInstanceOf(Collection::class,$user->projects());
    }
}
