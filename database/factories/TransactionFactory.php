<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Carbon\Carbon;

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
    public function definition()
    {
        $amount = rand(-1000, 1000) / 100;

        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();
        $dateTransaction = Carbon::createFromTimestamp(rand($startDate->timestamp, $endDate->timestamp));
        return [
            'name' => Str::random(10),
            'amount' => $amount,
            'date_transaction' => $dateTransaction,
        ];
    }
    public function run(): void
    {
        Transaction::factory()
            ->count(10)
            ->hasPosts(1)
            ->create();
    }
}
