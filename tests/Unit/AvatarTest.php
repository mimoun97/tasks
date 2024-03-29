<?php

namespace Tests\Unit;

use App\Avatar;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AvatarTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function setUser()
    {
        $avatar = Avatar::create([
            'url' => '/photo1.png',
        ]);
        $this->assertNull($avatar->user);
        $avatar->setUser($user = factory(User::class)->create());
        $avatar = $avatar->fresh();
        $this->assertNotNull($avatar->user);
        $this->assertEquals($avatar->user->name, $user->name);
    }

    /**
     * @test
     */
    public function map()
    {
        $avatar = Avatar::create([
            'url' => '/avatar.png',
        ]);
        $mappedAvatar = $avatar->map();
        $this->assertEquals($mappedAvatar['id'],1);
        $this->assertEquals($mappedAvatar['url'],'/avatar.png');
    }
}
