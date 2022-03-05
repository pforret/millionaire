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
        $name_records=SimpleExcelReader::create(__DIR__ . "/currency_names.csv")->useDelimiter(";")->getRows();
        foreach($name_records as $name_record){
            $currency_names[$name_record["code"]]=$name_record;
            $code = $name_record["code"];
            $name = $name_record["name"];
            $symbol = $name_record["symbol"];
            $country = $name_record["country"];
            $flag = $name_record["flag"];

            $currency = new Currency([
                "code"  =>  $code,
                "name"  =>  $name,
                "symbol"    =>  $symbol,
                "country"   =>  $country,
                "flag"   =>  $flag,
            ]);
            $currency->save();
        }
    }
}
