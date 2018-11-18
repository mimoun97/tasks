<?php

namespace Tests\Feature\Traits;

use App\User;

trait CanLogin
{
    protected function login($guard = null): void //$guard ->web/api
    {
        $user = factory(User::class)->create();
        $this->actingAs($user,$guard);
    }
}
