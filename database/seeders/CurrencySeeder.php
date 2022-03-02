<?php

namespace Database\Seeders;

use App\Models\Currency;
use App\Models\Rate;
use App\Services\ExchangeRateService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\SimpleExcel\SimpleExcelReader;


class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exchange = new ExchangeRateService();
        $rates_per_day = $exchange->get();
        /*
                 $data["Cube"]["Cube"][0]
        => [
             "@attributes" => [
               "time" => "2022-03-02",
             ],
             "Cube" => [
               [
                 "@attributes" => [
                   "currency" => "USD",
                   "rate" => "1.1106",
                 ],
               ],
               [
                 "@attributes" => [
                   "currency" => "JPY",
                   "rate" => "128.08",
                 ],

         */
        $name_records=SimpleExcelReader::create(__DIR__ . "/currency_names.csv")->useDelimiter(";")->getRows();
        $currency_names=[];
        foreach($name_records as $name_record){
            $currency_names[$name_record["code"]]=$name_record;
        }

        $last_rates = $rates_per_day[1];
        $rate_day = $last_rates["@attributes"]["time"];
        $currency = new Currency([
            "code"  =>  "EUR",
            "name"  =>  "European Euro",
            "symbol"    =>  "€",
            "country"   =>  "European Union",
            "flag"   =>  "",
        ]);
        $currency->save();
        $currency->rates()->saveMany([
            new Rate(
                [
                    "rate"  =>  1,
                    "date"  =>  $rate_day,
                ]
            ),
        ]);

        foreach($last_rates["Cube"] as $data_point){
            $code = $data_point["@attributes"]["currency"];
            $name = $currency_names[$code]["name"] ?? $code;
            $symbol = $currency_names[$code]["symbol"] ?? "";
            $country = $currency_names[$code]["country"] ?? "";
            $flag = $currency_names[$code]["flag"] ?? "";
            $rate = $data_point["@attributes"]["rate"];

            $currency = new Currency([
                "code"  =>  $code,
                "name"  =>  $name,
                "symbol"    =>  $symbol,
                "country"   =>  $country,
                "flag"   =>  $flag,
            ]);

            $currency->save();
            $currency->rates()->saveMany([
                new Rate(
                    [
                        "rate"  =>  $rate,
                        "date"  =>  $rate_day,
                    ]
                ),
            ]);
        }
    }
}
