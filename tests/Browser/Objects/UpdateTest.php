<?php

namespace Tests\Browser\Objects;

use Hydrofon\Object;
use Hydrofon\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UpdateTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Objects can be updated through create form.
     *
     * @return void
     */
    public function testObjectsCanBeUpdated()
    {
        $user   = factory(User::class)->create();
        $object = factory(Object::class)->create();

        $this->browse(function (Browser $browser) use ($user, $object) {
            $browser->loginAs($user)
                    ->visit('/objects/' . $object->id . '/edit')
                    ->type('name', 'New object Name')
                    ->press('Update')
                    ->assertPathIs('/objects')
                    ->assertSee('New object Name');
        });
    }

    /**
     * Objects can be updated through create form.
     *
     * @return void
     */
    public function testObjectsMustHaveAName()
    {
        $user   = factory(User::class)->create();
        $object = factory(Object::class)->create();

        $this->browse(function (Browser $browser) use ($user, $object) {
            $browser->loginAs($user)
                    ->visit('/objects/' . $object->id . '/edit')
                    ->type('name', '')
                    ->press('Update')
                    ->assertPathIs('/objects/' . $object->id . '/edit');
        });
    }
}