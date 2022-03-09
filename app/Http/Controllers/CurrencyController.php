<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Rate;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function show($code): View
    {
        $currency = Currency::whereCode($code)->first();
        $rates = Rate::query()->where("currency_id", "=", $currency->id)->orderBy("date")->get();
        $array_dates=[];
        $array_rates=[];
        foreach($rates as $rate){
            $array_dates[]=$rate->date;
            $array_rates[]=round(1000000 / $rate->rate,2);
            $last_rate = round(1000000 / $rate->rate,2);
        }

        $chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 100])
            ->labels($array_dates)
            ->datasets([
                [
                    "label" => "To be a millionaire in " . $currency->name . ", you'll need ... euro",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $array_rates,
                ]
            ])
            ->options([
                "scales"    =>  [
                    "yAxes"     =>  [
                        "ticks" =>  [
                            "beginAtZero"   =>  true,
                        ],
                        //"min"   =>  0,
                    ],
                ]
            ]);

        return view('currency.show', [
            "code"   => $code,
            "currency"  =>  $currency,
            "chartjs"   =>  $chartjs,
            "last_rate" =>  $last_rate,
            "page_title"    =>  "test",
            "page_url"      =>  env("APP_URL") . "in/" . $currency->code,
            "page_url_utm"      =>  env("APP_URL") . "in/" . $currency->code,
            "page_img"      =>  env("APP_URL") . "storage/" . $currency->code . ".jpg",
            "other_currencies"    =>  Rate::last_rates(),
            ]);
    }
}
