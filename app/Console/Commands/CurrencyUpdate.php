<?php

namespace App\Console\Commands;

use App\Models\Currency;
use App\Models\Rate;
use App\Services\EuRateService;
use App\Services\FloatRateService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CurrencyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'million:rates {--all} {--test} {{--float}}';

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
        $map_currencies=[];
        $currencies = Currency::query()->select(["id","code"])->get();
        foreach($currencies as $currency){
            $map_currencies[$currency->code]=$currency->id;
        }
        if($this->option("all")) {
            // take 90 days
            $rates = (new EuRateService())->get("EUR", 90);
        } else {
            // take only most recent
            //$all_rates = (new EuRateService())->get("EUR",7);
            $all_rates=(new FloatRateService())->get();
            $rates=array_slice($all_rates,0,1, true);
        }
        $nb_updates=0;
        $bar = $this->output->createProgressBar(count($rates));
        $bar->start();
        foreach($rates as $date => $day_rates){
            $bar->advance();
            if($date){
                //$this->info("Ingest rates for $date ...");
                foreach($day_rates as $currency => $rate){
                    $currency_id=$map_currencies[$currency] ?? "";
                    if($currency_id){
                        Rate::updateOrCreate(
                            [
                                "currency_id"   =>  $currency_id,
                                "date"          =>  $date,
                            ],
                            [
                                "rate"          =>  $rate,
                            ]
                        );
                        $nb_updates++;
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
                $nb_updates++;
            }
        }
        $bar->finish();
        $this->info("Total updates: $nb_updates");
        return 0;
    }
}
