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

class UsersControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;
    /**
     * @test */
    public function can_list_users()
    {
        $this->login('api');

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


        //$users = [$user1, $user2, $user3];

        $response = $this->json('GET', '/api/v1/users');
        $response->assertSuccessful();
        $result = json_decode($response->getContent());

        //var_dump($result[0]->name);
        //El metode login crea i registra un usuari.
        $this->assertEquals($result[1]->name, 'Benito Camelas');
        $this->assertEquals($result[1]->gravatar, 'https://www.gravatar.com/avatar/' . md5('benito@gmail.com'));
        $this->assertEquals($result[1]->email, 'benito@gmail.com');

        $this->assertEquals($result[2]->name, 'mimoun haddou');
        $this->assertEquals($result[2]->gravatar, 'https://www.gravatar.com/avatar/' .md5('mimoun@gmail.com'));
        $this->assertEquals($result[2]->email, 'mimoun@gmail.com');

        $this->assertEquals($result[3]->name, 'prova cognom');
        $this->assertEquals($result[3]->gravatar, 'https://www.gravatar.com/avatar/' . md5('prova@gmail.com'));
        $this->assertEquals($result[3]->email, 'prova@gmail.com');

    }
}
