<?php
/**
 * Created by PhpStorm.
 * User: mimoun
 * Date: 19/11/18
 * Time: 19:44
 */

namespace Tests\Unit;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{

    /**
     * @test
     */
    public function isSuperAdmin()
    {
        $user = factory(User::class)->create();

        $this->assertFalse($user->isSuperAdmin);

        $user->admin = true;

        $user->save();

        $this->assertTrue($user->isSuperAdmin);
    }
}
