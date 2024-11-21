<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;

class TransactionsTableSeeder extends Seeder
{
    public function run()
    {
        // Create 10,000 transactions using the factory
        Transaction::factory()->count(10000)->create();
    }
}
