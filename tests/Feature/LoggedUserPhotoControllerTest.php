<?php

namespace Tests\Feature;

use App\File;
use App\Photo;
use App\User;
use Illuminate\Support\Facades\Storage;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoggedUserPhotoControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;
    /**
     * @test
     */
    public function show_logged_user_default_photo()
    {
        $this->withoutExceptionHandling();
        $this->login();
        $response = $this->get('/user/photo');
        dd($response);
        $response->assertSuccessful();
        dd(storage_path(User::DEFAULT_PHOTO_PATH));
        
        $this->assertTrue(file_exists($response->baseResponse->getFile()->getPathName()));
        
        
        $this->assertEquals(storage_path(User::DEFAULT_PHOTO_PATH), $response->baseResponse->getFile()->getPathName());
        $response->assertSuccessful();
    }

    /** @test */
    public function show_user_photo()
    {
        $this->withoutExceptionHandling();
        Storage::fake('local');

        $user = factory(User::class)->create();

        Storage::disk('local')->put(
            [
                '/photos/' . $user->id . '.jpg',
                File::get(base_path('tests/__Fixtures__/photos/default.png'))
            ]
        );
        $photo = Photo::create([
            'url' => 'photos/' . $user->id . '.jpg',
        ]);
        $user->assignPhoto($photo);

        $this->actingAs($user,'web');
        $response = $this->get('/user/photo');
        $response->assertSuccessful();
        $this->assertEquals(Storage::disk('local')->path('photos/' . $user->id . '.jpg'), $response->baseResponse->getFile()->getPathName());
        $this->assertFileEquals(Storage::disk('local')->path('photos/' . $user->id . '.jpg'), $response->baseResponse->getFile()->getPathName());

        $response->assertSuccessful();

    }
}
