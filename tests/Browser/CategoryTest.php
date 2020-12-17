<?php

namespace Tests\Browser;

use CodeFlix\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $user = User::where('email', '=', 'admin@user.com')->first();
        $this->browse(function (Browser $browser) use ($user){
            //Test Create
            $browser->loginAs($user)
                    ->visit(route('admin.categories.index'))
                    ->assertSee('Listagem de Categorias')
                    ->clickLink('Nova Categoria')
                    ->assertSee('Nova Categoria')
                    ->type('name', 'TEST')
                    ->click('button[type=submit]')
                    ->assertSee('Listagem de Categorias')
                    ->assertSee('TEST');

            //Test Update
            $browser->click('a[href*="1/edit"]')
                    ->assertSee('Editar Categoria')
                    ->clear('name')
                    ->type('name', "TEST2")
                    ->click('button[type=submit]')
                    ->assertSee('Listagem de Categorias')
                    ->assertSee('TEST2');

            //Test Show
            $browser->click('a[href$="1"]')
                ->assertSee('Categoria')
                ->assertSee('Nome');

            //Test Delete
            $browser->click('a.btn-danger')
                ->assertSee('Listagem de Categorias')
                ->assertSee('Categoria excluída com Sucesso!');


        });
    }

    /**
     * @throws \Throwable
     */
    /*public function testRetrieve()
    {
        $user = User::where('email', '=', 'admin@user.com')->first();
        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($user)
                ->visit(route('admin.categories.index'))
                ->assertSee('Listagem de Categorias')
                ->click('text-danger')
                ->assertSee('Categoria')
                ->assertSee('Nome');
        });
    }*/

    /**
     * @throws \Throwable
     */
   /* public function testUpdate()
    {
        $user = User::where('email', '=', 'admin@user.com')->first();
        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($user)
                ->visit(route('admin.categories.index'))
                ->assertSee('Listagem de Categorias')
                ->click('text-warning')
                ->assertSee('Editar Categoria')
                ->clear('name')
                ->type('name', 'TEST2')
                ->click('button[type=submit]')
                ->assertSee('Listagem de Categorias')
                ->assertSee('TEST2');
        });
    }

    /*public function testDelete()
    {
        $user = User::where('email', '=', 'admin@user.com')->first();
        $this->browse(function (Browser $browser) use ($user){
            $browser->loginAs($user)
                ->visit(route('admin.categories.index'))
                ->assertSee('Listagem de Categorias')
                ->click('text-danger')
                ->assertSee('Categoria')
                ->assertSee('Nome');
        });
    }*/
}
