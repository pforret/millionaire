<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Rate;
use Box\Spout\Writer\Exception\WriterException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    static function million(Request $request): View
    {
        $currencies = Rate::last_rates();
        return view('millionaire', [
            "currencies" => $currencies,
            "page_title"    =>  "To be a millionaire in Russian Ruble, you'll need ? euro",
            "page_url"      =>  env("APP_URL") . "in/RUB" ,
            "page_img"      =>  env("APP_URL") . "storage/RUB.jpg",
        ]);
    }

    static function billion(Request $request): View
    {
        $last_day = Rate::query()->select("date")->max("date");
        $currencies = Currency::query()
            ->join("rates", "rates.currency_id", "=", "currencies.id")
            ->where("rates.date", "=", $last_day)
            ->orderBy("rates.rate")
            ->get();
        return view('billionaire', [
            "currencies" => $currencies,
            "page_title"    =>  "To be a billionaire in Russian Ruble, you'll need ? euro",
            "page_url"      =>  env("APP_URL") . "in/RUB" ,
            "page_img"      =>  env("APP_URL") . "storage/RUB.jpg",
        ]);
    }

}
