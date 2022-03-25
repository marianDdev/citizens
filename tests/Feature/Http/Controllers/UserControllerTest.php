<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\UserDetails;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Can delete user if user has no details
     *
     * @return void
     */
    public function test_user_can_be_deleted()
    {
        User::factory()
            ->count(7)
            ->create();

        $response = $this->delete('/api/users/6');

        $response->assertExactJson(
            [
                'id'      => 6,
                'status'  => 'deleted',
                'message' => 'User has been deleted.',
            ]
        );
    }

    /**
     * Can not delete user if user has details
     *
     * @return void
     */
    public function test_user_can_not_be_deleted()
    {
        User::factory()
            ->has(UserDetails::factory())
            ->create();

        $response = $this->delete('/api/users/1');

        $response->assertExactJson(
            [
                'id'      => 1,
                'status'  => 'not deleted',
                'message' => 'This user has details.',
            ]
        );
    }

    /**
     * User not found
     *
     * @return void
     */
    public function test_user_not_found()
    {
        User::factory()
            ->create();

        $response = $this->delete('/api/users/2');

        $response->assertNotFound();
    }
}
