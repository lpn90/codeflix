<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginFailed()
    {
        $this->browse(function (Browser $browser) {
            //Login Failed
            $browser->visit('/admin/login')
                    ->type('email', 'admin1@user.com')
                    ->type('password', '123456')
                    ->press('Login')
                    ->assertSee('Login');

            $browser->visit('/admin/login')
                ->type('email', 'admin@user.com')
                ->type('password', 'secret')
                ->press('Login')
                ->assertPathIs('/admin/dashboard')
                ->assertSee('Adminsitrativa Funcionando');
        });
    }
}
