<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Seed the application's database with currencies.
     */
    public function run(): void
    {
        DB::table('currencies')->insert([
            [
                'code' => 'UZS',
                'name' => 'сўм',
            ],
            [
                'code' => 'USD',
                'name' => '$',
            ],
        ]);
    }
}
