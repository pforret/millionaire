<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Rate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::whereCode("USD")->first()->rates()->saveMany([
            new Rate(
                [
                    "rate"  =>  1.1162,
                    "date"  =>  date("Y-m-d"),
                ]
            ),
        ]);
        Currency::whereCode("EUR")->first()->rates()->saveMany([
            new Rate(
                [
                    "rate"  =>  1,
                    "date"  =>  date("Y-m-d"),
                ]
            ),
        ]);
        Currency::whereCode("RUB")->first()->rates()->saveMany([
            new Rate(
                [
                    "rate"  =>  117.201,
                    "date"  =>  date("Y-m-d"),
                ]
            ),
        ]);
        Currency::whereCode("HUF")->first()->rates()->saveMany([
            new Rate(
                [
                    "rate"  =>  379.6,
                    "date"  =>  date("Y-m-d"),
                ]
            ),
        ]);
    }
}
