<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\Rate;
use App\Services\ExchangeRateService;
use Illuminate\Console\Command;

class CurrencyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'million:rates {--all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update currency rates for last day/all days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $exch = new ExchangeRateService();
        $rates = $exch->get();
        /*
        * (
        [@attributes] => Array ( [time] => 2022-03-04 )
        [Cube] => Array
            (
            [0] => Array ( [@attributes] => Array ( [currency] => USD [rate] => 1.0929 ) )
            [1] => Array ( [@attributes] => Array ( [currency] => JPY [rate] => 126.17 ) )
        */

        $currencies = Currency::query()->select(["id","code"])->get();
        $map_currencies=[];
        foreach($currencies as $currency){
            $map_currencies[$currency->code]=$currency->id;
        }
        if($this->option("all")){
            // insert/update all days
            foreach($rates as $day_rates){
                $date = $day_rates["@attributes"]["time"] ?? "";
                if($date){
                    $this->info("Ingest rates for $date ...");
                    foreach($day_rates["Cube"] as $rate_data){
                        $attributes = $rate_data["@attributes"];
                        $currency_id=$map_currencies[$attributes["currency"]] ?? "";
                        if($currency_id){
                            Rate::updateOrCreate(
                                [
                                    "currency_id"   =>  $currency_id,
                                    "date"          =>  $date,
                                ],
                                [
                                    "rate"          =>  $attributes["rate"] ?? 0
                                ]
                            );
                        }
                    }
                    Rate::updateOrCreate(
                        [
                            "currency_id"   =>  $map_currencies["EUR"],
                            "date"          =>  $date,
                        ],
                        [
                            "rate"          =>  1
                        ]
                    );
                }
            }
            $this->info("Total rates: " . Rate::all()->count());
        } else {
            // insert/update last day
            $last_rates=$rates[0];
            $date = $last_rates["@attributes"]["time"] ?? "";
            if($date){
                $this->info("Ingest rates for $date ...");
                foreach($last_rates["Cube"] as $rate_data){
                    $attributes = $rate_data["@attributes"];
                    $currency_id=$map_currencies[$attributes["currency"]] ?? "";
                    if($currency_id){
                        $this->info("Insert for $date/" . $attributes["currency"] . ": " . $attributes["rate"]);
                        Rate::updateOrCreate(
                            [
                                "currency_id"   =>  $currency_id,
                                "date"          =>  $date,
                            ],
                            [
                                "rate"          =>  $attributes["rate"] ?? 0,
                            ]
                        );
                    }
                }
                Rate::updateOrCreate(
                    [
                        "currency_id"   =>  $map_currencies["EUR"],
                        "date"          =>  $date,
                    ],
                    [
                        "rate"          =>  1
                    ]
                );

            }
            $this->info("Total rates: " . Rate::all()->count());
        }
        return 0;
    }
}
