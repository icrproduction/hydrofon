<?php

namespace Database\Factories;

use App\Models\Approval;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApprovalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Approval::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'booking_id' => \App\Models\Booking::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}