<?php

namespace Tests\Feature\Subscriptions;

use Hydrofon\User;
use Tests\TestCase;
use Hydrofon\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A user subscription can be shown.
     *
     * @return void
     */
    public function testUserSubscriptionIsShown()
    {
        $user = factory(User::class)->create();
        $subscription = factory(Subscription::class)->create([
            'subscribable_type' => \Hydrofon\User::class,
            'subscribable_id'   => $user->id,
        ]);

        $this->get('feeds/'.$subscription->uuid)
             ->assertStatus(200)
             ->assertHeader('Content-Type', 'text/calendar; charset=UTF-8');
    }
}
