<?php

namespace Tests\Feature\API;

use Dingo\Api\Routing\UrlGenerator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tymon\JWTAuth\JWT;
use Tymon\JWTAuth\JWTGuard;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCategoriesList()
    {
        $testResponse = $this->makeJWTToken();
        $token = $testResponse->json()['token'];

        $this->get('api/categories',[
            'Authorization' => "Bearer $token"
        ])->assertStatus(200)
        ->assertJsonStructure(['categories' => ['data']]);
    }

    protected function clearAuth()
    {
        $reflectionClass = new \ReflectionClass(JWTGuard::class);

        $reflectionProperty = $reflectionClass->getProperty('user');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue(\Auth::guard('api'), null);

        $jwt = app(JWT::class);
        $jwt->unsetToken();

        $dingoAuth = app(\Dingo\Api\Auth\Auth::class);
        $dingoAuth->setUser(null);
    }

    protected function makeJWTToken()
    {
        $urlGenerator = app(UrlGenerator::class)->version('v1');

        return $this->post($urlGenerator->route('api.access_token'), [
            'email' => 'admin@user.com',
            'password' => 'secret'
        ]);
    }
}
