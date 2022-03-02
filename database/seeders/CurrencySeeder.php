<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
            'code' => 'USD',
            'name' => "U.S. Dollar",
        ]);
        DB::table('currencies')->insert([
            'code' => 'EUR',
            'name' => "Euro",
        ]);
        DB::table('currencies')->insert([
            'code' => 'HUF',
            'name' => "Hungarian Forint",
        ]);
        DB::table('currencies')->insert([
            'code' => 'RUB',
            'name' => "Russian Ruble",
        ]);
    }
}
