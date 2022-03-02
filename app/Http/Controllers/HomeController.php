<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Rate;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    static function million(Request $request): View
    {
        $last_day = Rate::query()->select("date")->max("date");
        $currencies = Currency::query()
            ->join("rates", "rates.currency_id", "=", "currencies.id")
            ->where("rates.date", "=", $last_day)
            ->orderBy("rates.rate")
            ->get();
        return view('millionaire', ["currencies" => $currencies]);
    }

    static function billion(Request $request): View
    {
        $last_day = Rate::query()->select("date")->max("date");
        $currencies = Currency::query()
            ->join("rates", "rates.currency_id", "=", "currencies.id")
            ->where("rates.date", "=", $last_day)
            ->orderBy("rates.rate")
            ->get();
        return view('billionaire', ["currencies" => $currencies]);
    }

    static function test(Request $request): View
    {
        $chartjs = app()->chartjs
            ->name('lineChartTest')
            ->type('line')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['January', 'February', 'March', 'April', 'May', 'June', 'July'])
            ->datasets([
                [
                    "label" => "My First dataset",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [65, 59, 80, 81, 56, 55, 40],
                ],
                [
                    "label" => "My Second dataset",
                    'backgroundColor' => "rgba(38, 185, 154, 0.31)",
                    'borderColor' => "rgba(38, 185, 154, 0.7)",
                    "pointBorderColor" => "rgba(38, 185, 154, 0.7)",
                    "pointBackgroundColor" => "rgba(38, 185, 154, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => [12, 33, 44, 44, 55, 23, 40],
                ]
            ])
            ->options([]);

        return view('test.chartjs', compact('chartjs'));
    }
}
