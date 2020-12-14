<?php

namespace Tests\Feature\API;

use Dingo\Api\Routing\UrlGenerator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAccessToken()
    {
        $urlGenerator = app(UrlGenerator::class)->version('v1');

        $this->post($urlGenerator->route('api.access_token'), [
            'email' => 'admin@user.com',
            'password' => 'secret'
        ])
            ->assertStatus(200);
    }
}
