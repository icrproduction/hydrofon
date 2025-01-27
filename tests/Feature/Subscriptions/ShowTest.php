<?php

namespace Tests\Feature\Subscriptions;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
        $subscription = Subscription::factory()->user()->create();

        $this->get('feeds/'.$subscription->uuid)
             ->assertStatus(200)
             ->assertHeader('Content-Type', 'text/calendar; charset=UTF-8');
    }
}
