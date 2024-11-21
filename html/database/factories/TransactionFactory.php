<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'customer_id' => $this->faker->numberBetween(1, 100), // Assuming customer_id exists
            'transaction_type' => $this->faker->numberBetween(1, 3), // Example: 1=deposit, 2=withdrawal, etc.
            'amount' => $this->faker->randomFloat(2, 10, 10000), // Random amount between 10 and 10,000
            'transaction_status' => $this->faker->numberBetween(0, 1), // 0 = pending, 1 = completed
            'transaction_date' => $this->faker->dateTimeBetween('-2 years', 'now'), // Random date in the past 2 years
            'description' => $this->faker->sentence, // Random sentence for description
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
