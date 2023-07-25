<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Transaction;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class TransactionSeeder extends Seeder
{
    public function run()
    {
        $amount = rand(-10000, 10000) / 100;

        $startDate = Carbon::now()->subDays(30);
        $endDate = Carbon::now();
        $dateTransaction = Carbon::createFromTimestamp(rand($startDate->timestamp, $endDate->timestamp));

        DB::table('transactions')->insert([
            'name' => Str::random(10),
            'amount' => $amount,
            'date_transaction' => $dateTransaction,
        ]);
    }
}
