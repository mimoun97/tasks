<?php
/**
 * Created by PhpStorm.
 * User: mimoun
 * Date: 20/11/18
 * Time: 20:01
 */

namespace Tests\Feature\Api;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class RegularUsersControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;
    /**
     * @test */
    public function can_list_regular_users()
    {
        //$this->login();
        $this->withoutExceptionHandling();
        $user1 = factory(User::class)->create([
            'name' => 'Benito Camelas',
            'email' => 'benito@gmail.com',
        ]);

        $user2 = factory(User::class)->create([
            'name' => 'mimoun haddou',
            'email' => 'mimoun@gmail.com',
        ]);

        $user3 = factory(User::class)->create([
            'name' => 'prova cognom',
            'email' => 'prova@gmail.com',
        ]);

        $user3->admin = true;
        $user3->save();
        $this->actingAs($user1,'api');
        $response = $this->json('GET', '/api/v1/regular_users');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());

        $this->assertEquals($result[0]->name, 'Benito Camelas');
        $this->assertEquals($result[0]->gravatar, 'https://www.gravatar.com/avatar/' . md5('benito@gmail.com'));
        $this->assertEquals($result[0]->email, 'benito@gmail.com');

        $this->assertEquals($result[1]->name, 'mimoun haddou');
        $this->assertEquals($result[1]->gravatar, 'https://www.gravatar.com/avatar/' .md5('mimoun@gmail.com'));
        $this->assertEquals($result[1]->email, 'mimoun@gmail.com');

        //$this->assertNull($result[2]);
    }
}
